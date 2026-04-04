<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of blogs
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        
        // Calculate statistics
        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::where('status', 'published')->count();
        $draftBlogs = Blog::where('status', 'draft')->count();
        $totalViews = Blog::sum('views');
        
        return view('dashboard.admin.blog', compact('blogs', 'totalBlogs', 'publishedBlogs', 'draftBlogs', 'totalViews'));
    }

    /**
     * Show the blog editor page
     */
    public function editor($id = null)
    {
        $blog = null;
        if ($id) {
            $blog = Blog::findOrFail($id);
        }
        return view('dashboard.admin.blog-editor', compact('blog'));
    }

    /**
     * Store a newly created blog
     */
    public function store(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'error' => 'Non authentifié'
            ], 401);
        }
        
        try {
            
            $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author_name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed: ' . implode(', ', array_flatten($e->errors()))
            ], 422);
        }

        try {
            // Handle featured image upload
            $featuredImagePath = null;
            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                $imageName = Str::slug($request->title) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $featuredImagePath = $image->storeAs('blog', $imageName, 'public');
            }

            // Calculate reading time (average 200 words per minute)
            $wordCount = str_word_count(strip_tags($request->content));
            $readingTime = max(1, round($wordCount / 200));
            // Process tags
            $tags = [];
            if ($request->tags) {
                $tags = array_map('trim', explode(',', $request->tags));
                $tags = array_filter($tags); // Remove empty tags
            }
            $blog = Blog::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'excerpt' => $request->excerpt,
                'content' => $request->content,
                'author_name' => $request->author_name,
                'category' => $request->category,
                'status' => $request->status,
                'tags' => $tags,
                'reading_time' => $readingTime,
                'featured_image' => $featuredImagePath
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Article créé avec succès',
                'blog' => $blog
            ]);
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'error' => 'Erreur lors de la création de l\'article: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified blog
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('dashboard.admin.blog-show', compact('blog'));
    }

    /**
     * Update the specified blog
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        
        
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'excerpt' => 'required|string|max:500',
                'content' => 'required|string',
                'author_name' => 'required|string|max:255',
                'category' => 'required|string|max:100',
                'status' => 'required|in:draft,published',
                'tags' => 'nullable|string',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed: ' . implode(', ', array_flatten($e->errors()))
            ], 422);
        }

        try {
            $data = [
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'excerpt' => $request->excerpt,
                'content' => $request->content,
                'author_name' => $request->author_name,
                'category' => $request->category,
                'status' => $request->status
            ];

            // Handle featured image upload if new image provided
            if ($request->hasFile('featured_image')) {
                // Delete old image
                if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                    Storage::disk('public')->delete($blog->featured_image);
                }
                
                $image = $request->file('featured_image');
                $imageName = Str::slug($request->title) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $data['featured_image'] = $image->storeAs('blog', $imageName, 'public');
            } else {
                // Keep existing featured image if no new image is provided
                $data['featured_image'] = $blog->featured_image;
            }
            

            // Calculate reading time
            $wordCount = str_word_count(strip_tags($request->content));
            $data['reading_time'] = max(1, round($wordCount / 200));

            // Process tags
            $tags = [];
            if ($request->tags) {
                $tags = array_map('trim', explode(',', $request->tags));
                $tags = array_filter($tags);
            }
            $data['tags'] = $tags;

            $blog->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Article modifié avec succès',
                'blog' => $blog
            ]);
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'error' => 'Erreur lors de la modification de l\'article: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified blog
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        
        try {
            // Delete featured image
            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            
            $blog->delete();

            return response()->json([
                'success' => true,
                'message' => 'Article supprimé avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Erreur lors de la suppression de l\'article: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle status
     */
    public function toggleStatus($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update(['status' => $blog->status === 'published' ? 'draft' : 'published']);
        
        return response()->json([
            'success' => true,
            'status' => $blog->status,
            'message' => $blog->status === 'published' ? 'Article publié' : 'Article mis en brouillon'
        ]);
    }

    /**
     * Upload image for blog content
     */
    public function uploadImage(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        try {
            $image = $request->file('image');
            $filename = 'blog-content-' . time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/blog-content', $filename);
            $url = Storage::url($path);

            return response()->json([
                'success' => true,
                'url' => $url,
                'message' => 'Image uploaded successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to upload image',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
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
        $this->authorize('scanner-pass');
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of blogs
     */
    public function index()
    {
        $this->authorize('scanner-pass');
        $this->authorize('viewAny', Blog::class);

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
        $this->authorize('scanner-pass');
        $this->authorize('create', Blog::class);

        $blog = null;
        if ($id) {
            $blog = Blog::findOrFail($id);
            $this->authorize('update', $blog);
        }
        return view('dashboard.admin.blog-editor', compact('blog'));
    }

    /**
     * Store a newly created blog
     */
    public function store(Request $request)
    {
        $this->authorize('scanner-pass'); $this->authorize('create', Blog::class); try { $request->validate([ 'title' => 'required|string|max:255', 'excerpt' => 'required|string|max:500', 'content' => 'required|string', 'author_name' => 'required|string|max:255', 'category' => 'required|string|max:100', 'status' => 'required|in:draft,published', 'tags' => 'nullable|string', 'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' ]); } catch (\Illuminate\Validation\ValidationException $e) { return api_json([ 'success' => false, 'error' => 'Validation failed: ' . implode(', ', array_flatten($e->errors())) ], 422); } try { $featuredImagePath = null; if ($request->hasFile('featured_image')) { $image = $request->file('featured_image'); $imageName = Str::slug($request->title) . '_' . time() . '.' . $image->getClientOriginalExtension(); $featuredImagePath = $image->storeAs('blog', $imageName, 'public'); } $wordCount = str_word_count(strip_tags($request->content)); $readingTime = max(1, round($wordCount / 200)); $tags = []; if ($request->tags) { $tags = array_map('trim', explode(',', $request->tags)); $tags = array_filter($tags); } $blog = Blog::create([ 'title' => $request->title, 'slug' => Str::slug($request->title), 'excerpt' => $request->excerpt, 'content' => $request->content, 'author_name' => $request->author_name, 'category' => $request->category, 'status' => $request->status, 'tags' => $tags, 'reading_time' => $readingTime, 'featured_image' => $featuredImagePath ]); return api_json([ 'success' => true, 'message' => 'Article créé avec succès', 'blog' => $blog ]); } catch (\Exception $e) { return api_json([ 'success' => false, 'error' => 'Erreur lors de la création de l\'article: ' . $e->getMessage() ], 500); }
    }

    /**
     * Display the specified blog
     */
    public function show($id)
    {
        $this->authorize('scanner-pass');
        $blog = Blog::findOrFail($id);
        $this->authorize('view', $blog);

        return view('dashboard.admin.blog-show', compact('blog'));
    }

    /**
     * Update the specified blog
     */
    public function update(Request $request, $id)
    {
        $this->authorize('scanner-pass'); $blog = Blog::findOrFail($id); $this->authorize('update', $blog); try { $request->validate([ 'title' => 'required|string|max:255', 'excerpt' => 'required|string|max:500', 'content' => 'required|string', 'author_name' => 'required|string|max:255', 'category' => 'required|string|max:100', 'status' => 'required|in:draft,published', 'tags' => 'nullable|string', 'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' ]); } catch (\Illuminate\Validation\ValidationException $e) { return api_json([ 'success' => false, 'error' => 'Validation failed: ' . implode(', ', array_flatten($e->errors())) ], 422); } try { $data = [ 'title' => $request->title, 'slug' => Str::slug($request->title), 'excerpt' => $request->excerpt, 'content' => $request->content, 'author_name' => $request->author_name, 'category' => $request->category, 'status' => $request->status ]; if ($request->hasFile('featured_image')) { if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) { Storage::disk('public')->delete($blog->featured_image); } $image = $request->file('featured_image'); $imageName = Str::slug($request->title) . '_' . time() . '.' . $image->getClientOriginalExtension(); $data['featured_image'] = $image->storeAs('blog', $imageName, 'public'); } else { $data['featured_image'] = $blog->featured_image; } $wordCount = str_word_count(strip_tags($request->content)); $data['reading_time'] = max(1, round($wordCount / 200)); $tags = []; if ($request->tags) { $tags = array_map('trim', explode(',', $request->tags)); $tags = array_filter($tags); } $data['tags'] = $tags; $blog->update($data); return api_json([ 'success' => true, 'message' => 'Article modifié avec succès', 'blog' => $blog ]); } catch (\Exception $e) { return api_json([ 'success' => false, 'error' => 'Erreur lors de la modification de l\'article: ' . $e->getMessage() ], 500); }
    }

    /**
     * Remove the specified blog
     */
    public function destroy($id)
    {
        $this->authorize('scanner-pass');
        $blog = Blog::findOrFail($id);
        $this->authorize('delete', $blog);
        
        try {
            // Delete featured image
            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            
            $blog->delete();

            return api_json([
                'success' => true,
                'message' => 'Article supprimé avec succès'
            ]);
        } catch (\Exception $e) {
            return api_json([
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
        $this->authorize('scanner-pass');
        $blog = Blog::findOrFail($id);
        $this->authorize('update', $blog);

        $blog->update(['status' => $blog->status === 'published' ? 'draft' : 'published']);
        
        return api_json([
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
        $this->authorize('scanner-pass');
        $this->authorize('create', Blog::class);

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        try {
            $image = $request->file('image');
            $filename = 'blog-content-' . time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/blog-content', $filename);
            $url = Storage::url($path);

            return api_json([
                'success' => true,
                'url' => $url,
                'message' => 'Image uploaded successfully'
            ]);
        } catch (\Exception $e) {
            return api_json([
                'error' => 'Failed to upload image',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
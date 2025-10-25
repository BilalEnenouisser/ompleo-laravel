<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts (Public API)
     */
    public function index(Request $request)
    {
        $query = Blog::where('status', 'published');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('author_name', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by tags
        if ($request->filled('tags')) {
            $tags = explode(',', $request->tags);
            $query->where(function($q) use ($tags) {
                foreach ($tags as $tag) {
                    $q->orWhereJsonContains('tags', trim($tag));
                }
            });
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'views':
                $query->orderBy('views', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $blogs = $query->paginate($request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => $blogs,
            'message' => 'Blog posts retrieved successfully'
        ]);
    }

    /**
     * Display the specified blog post (Public API)
     */
    public function show(Blog $blog)
    {
        if ($blog->status !== 'published') {
            return response()->json([
                'success' => false,
                'message' => 'Blog post not found'
            ], 404);
        }

        // Increment view count
        $blog->increment('views');

        return response()->json([
            'success' => true,
            'data' => $blog,
            'message' => 'Blog post retrieved successfully'
        ]);
    }
}

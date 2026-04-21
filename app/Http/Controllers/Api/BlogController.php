<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts (Public API)
     */
    public function index(Request $request)
    {
        $query = Blog::where('status', 'published'); if ($request->filled('search')) { $search = $request->search; $query->where(function($q) use ($search) { $q->where('title', 'like', "%{$search}%") ->orWhere('excerpt', 'like', "%{$search}%") ->orWhere('content', 'like', "%{$search}%") ->orWhere('author_name', 'like', "%{$search}%"); }); } if ($request->filled('category')) { $query->where('category', $request->category); } if ($request->filled('tags')) { $tags = explode(',', $request->tags); $query->where(function($q) use ($tags) { foreach ($tags as $tag) { $q->orWhereJsonContains('tags', trim($tag)); } }); } $sort = $request->get('sort', 'newest'); switch ($sort) { case 'title': $query->orderBy('title', 'asc'); break; case 'oldest': $query->orderBy('created_at', 'asc'); break; case 'views': $query->orderBy('views', 'desc'); break; case 'newest': default: $query->orderBy('created_at', 'desc'); break; } $blogs = $query->paginate($request->get('per_page', 10)); return BlogResource::collection($blogs) ->additional([ 'success' => true, 'message' => 'Blog posts retrieved successfully', ]);
    }

    /**
     * Display the specified blog post (Public API)
     */
    public function show(Blog $blog)
    {
        if ($blog->status !== 'published') {
            return api_json([
                'success' => false,
                'message' => 'Blog post not found'
            ], 404);
        }

        // Increment view count
        $blog->increment('views');

        return (new BlogResource($blog))
            ->additional([
                'success' => true,
                'message' => 'Blog post retrieved successfully',
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('blog.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        $this->authorize('view', $blog);

        // Get related blogs (same category or recent blogs)
        $relatedBlogs = Blog::where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->where(function($query) use ($blog) {
                $query->where('category', $blog->category)
                      ->orWhere('created_at', '>=', now()->subDays(30));
            })
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('blog.show', compact('blog', 'relatedBlogs'));
    }
}

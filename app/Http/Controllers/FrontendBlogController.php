<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class FrontendBlogController
{
    public function index()
    {
        $blogs = Blog::where('is_active', 1)->get();

        return view("frontend.blog.index", compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view("frontend.blog.show", compact('blog'));
    }
}

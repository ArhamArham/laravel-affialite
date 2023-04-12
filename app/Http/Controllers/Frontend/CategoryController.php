<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;

class CategoryController
{
    public function index()
    {
        $categories = Category::where('is_active', 1)
            ->latest()
            ->get();

        return view('frontend.category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load('stores');

        return view('frontend.category.show', compact('category'));
    }
}

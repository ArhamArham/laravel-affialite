<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            "name"              => 'required|max:255',
            "icon"              => 'required',
            "meta_title"        => 'nullable|max:255',
            "meta_keywords"     => 'nullable|max:255',
            "meta_description"  => 'nullable|max:1000',
            "is_active"         => 'required|boolean',
            "featured_for_home" => 'required|boolean',
        ]);

        Category::create([
            "name"              => $validated["name"],
            "icon"              => $validated["icon"],
            "meta_title"        => $validated["meta_title"],
            "meta_keywords"     => $validated["meta_keywords"],
            "meta_description"  => $validated["meta_description"],
            "is_active"         => $validated["is_active"],
            "featured_for_home" => $validated["featured_for_home"],
        ]);

        return response('', 201);
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, Category $category)
    {
        $validated = $this->validate($request, [
            "name"              => 'required|max:255',
            "icon"              => 'required',
            "meta_title"        => 'nullable|max:255',
            "meta_keywords"     => 'nullable|max:255',
            "meta_description"  => 'nullable|max:1000',
            "is_active"         => 'required|boolean',
            "featured_for_home" => 'required|boolean',
        ]);

        $category->update([
            "name"              => $validated["name"],
            "icon"              => $validated["icon"],
            "meta_title"        => $validated["meta_title"],
            "meta_keywords"     => $validated["meta_keywords"],
            "meta_description"  => $validated["meta_description"],
            "is_active"         => $validated["is_active"],
            "featured_for_home" => $validated["featured_for_home"],
        ]);

        return response('', 204);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect(route('categoryManagement.category.index'));
    }
}

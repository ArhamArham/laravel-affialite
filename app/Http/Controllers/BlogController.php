<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Store;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BlogController extends Controller
{

    public function index(): View
    {
        return view('admin.blog.index');
    }

    public function create(): View
    {
        $categories = BlogCategory::where('is_active', 1)
            ->get(['id', 'name']);

        $stores = Store::where('is_active', 1)
            ->get(['id', 'name']);

        return view('admin.blog.create', compact('categories', 'stores'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): Response
    {
        $validated = $this->runValidation($request);

        unset($validated['stores']);

        $blog = auth()->user()->blogs()
            ->create($validated);

        $blog->stores()->sync(
            (array)@ $request->get('stores')
        );

        return response('', 201);
    }


    public function edit(Blog $blog): View
    {
        $blog->load('stores');

        $categories = BlogCategory::where('is_active', 1)
            ->get(['id', 'name']);

        $stores = Store::where('is_active', 1)
            ->get(['id', 'name']);

        return view('admin.blog.edit', compact('blog', 'categories', 'stores'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, Blog $blog): Response
    {
        $validated = $this->runValidation($request);

        unset($validated['stores']);

        $blog->update($validated);

        $blog->stores()->sync(
            $request->get('stores')
        );

        return response('', 204);
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->stores()->sync([]);

        $blog->delete();

        return redirect(route('advertisement.blog.index'));
    }

    /**
     * @throws ValidationException
     */
    private function runValidation(Request $request): array
    {
        return $this->validate($request, [
            "title"             => 'required|max:255',
            "short_description" => 'required|max:500',
            "long_description"  => 'required',
            "image"             => 'required',
            "image_alt"         => 'nullable',
            "meta_title"        => 'nullable',
            "meta_keywords"     => 'nullable',
            "meta_description"  => 'nullable',
            "blog_category_id"  => 'required|exists:tbl_blog_categories,id',
            "featured_for_home" => 'required|boolean',
            "is_active"         => 'required|boolean',
            "stores"            => "nullable|array",
            "stores.*"          => 'exists:tbl_stores,id'
        ]);
    }
}

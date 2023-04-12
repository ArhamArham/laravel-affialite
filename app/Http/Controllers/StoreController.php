<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class StoreController extends Controller
{

    public function index(): View
    {
        return view('admin.store.index');
    }

    public function create(): View
    {
        $categories = Category::select('id', 'name', 'is_active')
            ->where('is_active', 1)
            ->get();

        return view('admin.store.create', compact('categories'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): Response
    {
        $validated = $this->runValidation($request);

        auth()->user()->stores()
            ->create($validated);

        return response('', 201);
    }


    public function edit(Store $store): View
    {
        $categories = Category::select('id', 'name', 'is_active')
            ->where('is_active', 1)
            ->get();

        return view('admin.store.edit', compact('store', 'categories'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, Store $store): Response
    {
        $validated = $this->runValidation($request);

        $store->update($validated);

        return response('', 204);
    }

    public function destroy(Store $store): RedirectResponse
    {
        $store->delete();

        return redirect(route('affiliate.store.index'));
    }

    /**
     * @throws ValidationException
     */
    private function runValidation(Request $request): array
    {
        return $this->validate($request, [
            "name"              => 'required|max:255',
            "heading"           => 'required|max:255',
            "image"             => 'required',
            "image_alt"         => 'nullable',
            "category_id"       => 'required|exists:tbl_categories,id',
            "short_description" => 'required|max:500',
            "long_description"  => 'required',
            "direct_url"        => 'required|max:255|url',
            "tracking_url"      => 'required|max:255|url',
            "meta_title"        => 'nullable',
            "meta_keywords"     => 'nullable',
            "meta_description"  => 'nullable',
            "facebook_link"     => 'nullable|max:255|url',
            "pinterest_link"    => 'nullable|max:255|url',
            "wikipedia_link"    => 'nullable|max:255|url',
            "twitter_link"      => 'nullable|max:255|url',
            "google_plus_link"  => 'nullable|max:255|url',
            "android_app_link"  => 'nullable|max:255|url',
            "ios_app_link"      => 'nullable|max:255|url',
            "is_active"         => 'required|boolean',
            "top_store"         => 'required|boolean',
            "editor_choice"     => 'required|boolean',
        ]);
    }
}

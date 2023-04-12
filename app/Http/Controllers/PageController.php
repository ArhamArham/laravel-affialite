<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    public function index(): View
    {
        return view('admin.page.index');
    }

    public function create(): View
    {
        return view('admin.page.create');
    }

    /**
     * @throws ValidationException
     * @throws \Exception
     */
    public function store(Request $request): Response
    {
        $validated = $this->runValidation($request);

        Page::create($validated);

        return response('', 201);
    }


    public function edit(Page $page): View
    {
        return view('admin.page.edit',
            compact('page')
        );
    }

    /**
     * @throws ValidationException
     * @throws \Exception
     */
    public function update(Request $request, Page $page): Response
    {
        $validated = $this->runValidation($request);

        $page->update($validated);

        return response('', 204);
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect(route('advertisement.page.index'));
    }

    /**
     * @throws ValidationException
     */
    private function runValidation(Request $request): array
    {
        return $this->validate($request, [
            'title'            => 'required|max:255',
            'slug'             => 'required|max:255',
            'content'          => 'required',
            'is_active'        => 'required|boolean',
            'meta_title'       => 'nullable|max:255',
            'meta_keywords'    => 'nullable|max:255',
            'meta_description' => 'nullable',
        ]);
    }
}
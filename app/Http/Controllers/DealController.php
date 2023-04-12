<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class DealController extends Controller
{

    public function index(): View
    {
        return view('admin.deal.index');
    }

    public function create(): View
    {
        return view('admin.deal.create');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): Response
    {
        $validated = $this->runValidation($request);

        auth()->user()->deals()
            ->create($validated);

        return response('', 201);
    }


    public function edit(Deal $deal): View
    {
        return view('admin.deal.edit', compact('deal'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, Deal $deal): Response
    {
        $validated = $this->runValidation($request);

        $deal->update($validated);

        return response('', 204);
    }

    public function destroy(Deal $deal): RedirectResponse
    {
        $deal->delete();

        return redirect(route('advertisement.deal.index'));
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
            "meta_title"        => 'nullable',
            "meta_keywords"     => 'nullable',
            "meta_description"  => 'nullable',
            "is_active"         => 'required|boolean',
        ]);
    }
}

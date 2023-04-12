<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Store;

class SearchController
{
    public function __invoke(): string
    {
        $stores = Store::query()
            ->select('id', 'name', 'image', 'slug', 'image_alt')
            ->where('name', 'like', "%" . request('q') . "%")
            ->limit(7)
            ->get();

        return view('frontend.search.search',
            compact('stores')
        )->render();
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Store;
use Illuminate\Contracts\View\View;

class StoreController
{
    public function index(): View
    {
        $stores = Store::where('is_active', 1)
            ->latest()
            ->get();

        return view('frontend.store.index', compact('stores'));
    }

    public function show(Store $store): View
    {
        $store->load('coupons');

        return view('frontend.store.show', compact('store'));
    }
}

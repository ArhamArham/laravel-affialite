<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Page;
use App\Models\Store;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = $this->cachedIt('homepageCategories',
            fn() => Category::query()
                ->select('id', 'name', 'slug', 'icon', 'is_active')
                ->where('is_active', true)
                ->withCount('stores')
                ->limit(9)->get()
        );

        $coupons = $this->cachedIt('homepageCoupons',
            fn() => Coupon::with('store')
                ->limit(20)
                ->get()
        );

        $stores = $this->cachedIt('homepageStores',
            fn() => Store::query()
                ->where('is_active', 1)
                ->limit(20)
                ->get()
        );

        return view('frontend.home', compact(
            'categories', 'coupons',
            'stores'
        ));
    }

    public function page(Page $page): View
    {
        abort_if($page->is_active == 0, 404);

        return view('frontend.page', compact('page'));
    }

    public function cachedIt($key, $fn, $tl = 2)
    {
        return Cache::remember(
            $key,
            now()->addHours($tl),
            $fn
        );
    }
}

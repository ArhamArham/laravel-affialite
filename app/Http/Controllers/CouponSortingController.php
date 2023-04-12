<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Store;
use App\Models\TopMentor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CouponSortingController extends Controller
{
    public function index(): View|Collection
    {
        if (\request()->wantsJson()) {
            return Coupon::where('store_id', \request('store_id'))
                ->orderBy('sort_by', 'asc')
                ->get();
        }

        $stores = Store::where('is_active', 1)->get();

        return view('admin.coupon.sorting.index', compact('stores'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'store_id'  => 'required|exists:tbl_stores,id',
            'coupons'   => 'required|array',
            'coupons.*' => 'exists:tbl_coupons,id'
        ]);

        if (count((array)$request->get('coupons'))) {
            collect($request->get('coupons'))->each(function ($id, $index) {
                Coupon::find($id)?->update([
                    'sort_by' => $index
                ]);
            });
        }

        return response('', 204);
    }
}

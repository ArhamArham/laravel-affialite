<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Store;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CouponController extends Controller
{

    public function index(): View
    {
        return view('admin.coupon.index');
    }

    public function create(): View
    {
        $stores = Store::where('is_active', true)
            ->get(['id', 'name']);

        return view('admin.coupon.create', compact('stores'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): Response
    {
        $validated = $this->runValidation($request);

        auth()->user()->coupons()
            ->create($validated);

        return response('', 201);
    }


    public function edit(Coupon $coupon): View
    {
        $stores = Store::where('is_active', true)
            ->get(['id', 'name']);

        return view('admin.coupon.edit', compact('coupon', 'stores'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, Coupon $coupon): Response
    {
        $validated = $this->runValidation($request);

        $coupon->update($validated);

        return response('', 204);
    }

    public function destroy(Coupon $coupon): RedirectResponse
    {
        $coupon->delete();

        return redirect(route('affiliate.coupon.index'));
    }

    /**
     * @throws ValidationException
     */
    private function runValidation(Request $request): array
    {
        return $this->validate($request, [
            "store_id"          => 'required|exists:tbl_stores,id',
            'offer_box'         => 'required|max:255',
            'offer_details'     => 'required|max:500',
            'tracking_link'     => 'required|url|max:255',
            'expiry_date'       => 'required|date',
            'type'              => 'required|in:deal,code',
            'code'              => 'nullable|max:50',
            'featured_for_home' => 'required|boolean',
            'is_active'         => 'required|boolean'
        ]);
    }
}

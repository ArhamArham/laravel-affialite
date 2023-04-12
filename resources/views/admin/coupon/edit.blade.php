<x-layout title="Edit Coupon">

    <coupon-edit
        :stores="{{ $stores->toJson() }}"
        :coupon="{{ $coupon->toJson() }}"
    ></coupon-edit>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

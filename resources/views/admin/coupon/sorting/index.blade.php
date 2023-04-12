<x-layout title="Coupon Sorting">

    <coupon-sorting
        :stores="{{ $stores->toJson() }}"
    ></coupon-sorting>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

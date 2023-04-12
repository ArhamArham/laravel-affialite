<x-layout title="Create Coupon">

    <coupon-add
        :stores="{{ $stores->toJson() }}"
    ></coupon-add>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

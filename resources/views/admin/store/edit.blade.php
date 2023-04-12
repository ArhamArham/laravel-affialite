<x-layout title="Edit Store">

    <store-edit
        :categories="{{ $categories->toJson() }}"
        :store="{{ $store->toJson() }}"
    ></store-edit>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

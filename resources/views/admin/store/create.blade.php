<x-layout title="Create Store">

    <store-add
        :categories="{{ $categories->toJson() }}"
    ></store-add>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

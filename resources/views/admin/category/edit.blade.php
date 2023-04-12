<x-layout title="Edit Category">

    <category-edit
        :category="{{ $category->toJson() }}"
    ></category-edit>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

<x-layout title="Create Blog">

    <blog-add
        :stores="{{ $stores->toJson() }}"
        :categories="{{ $categories->toJson() }}"
    ></blog-add>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

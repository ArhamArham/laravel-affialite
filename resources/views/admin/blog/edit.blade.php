<x-layout title="Edit Blog">

    <blog-edit
        :stores="{{ $stores->toJson() }}"
        :categories="{{ $categories->toJson() }}"
        :blog="{{ $blog->toJson() }}"
    ></blog-edit>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

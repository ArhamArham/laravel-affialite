<x-layout title="Edit Page">

    <edit-page
            :page="{{ $page->toJson() }}">
    </edit-page>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

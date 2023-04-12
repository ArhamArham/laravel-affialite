<x-layout title="Create User">

    <user-add
        :roles="{{ $roles->toJson() }}"
        :networks="{{ $networks->toJson() }}"
    ></user-add>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

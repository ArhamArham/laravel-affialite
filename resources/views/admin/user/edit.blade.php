<x-layout title="Edit User">

    <user-edit
        :roles="{{ $roles->toJson() }}"
        :networks="{{ $networks->toJson() }}"
        :user="{{ $user->toJson() }}"
    ></user-edit>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

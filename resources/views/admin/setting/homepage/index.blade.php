<x-admin.layout title="Homepage Setting">

    <homepage-setting
        :setting="{{ $setting->toJson() }}"
    />

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-admin.layout>

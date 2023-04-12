<x-layout title="Website Setting">

    <website-setting
        :setting="{{ $setting->toJson() }}"
    />

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

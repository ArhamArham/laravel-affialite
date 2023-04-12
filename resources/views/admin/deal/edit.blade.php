<x-layout title="Edit Deal">

    <deal-edit
        :deal="{{ $deal->toJson() }}"
    ></deal-edit>

    <x-slot name="script">
        <script src="{{ mix('js/app.js') }}"></script>
    </x-slot>
</x-layout>

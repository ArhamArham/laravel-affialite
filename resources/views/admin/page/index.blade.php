<x-layout title="Page Listing">
    <x-slot name="style">
        <livewire:styles/>
    </x-slot>

    <livewire:page-list/>
    <form action="" id="deleteForm" method="post">
        @csrf
        @method('DELETE')
    </form>
    <x-slot name="script">
        <livewire:scripts/>
        <script>
            document.querySelectorAll('.deleteBtn').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.getElementById('deleteForm').action = e.target.href
                    document.getElementById('deleteForm').submit();
                })
            })
        </script>
    </x-slot>
</x-layout>

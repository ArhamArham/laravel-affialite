<x-layout title="Blog Listing">

    <livewire:blog-list/>

    <form action="" id="deleteForm" method="post">
        @csrf
        @method('DELETE')
    </form>

    <x-slot name="script">
        <livewire:scripts/>

        <script>
            document
                .querySelector('.deleteBtn')
                .addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = document.getElementById('deleteForm');
                    form.action = e.target.href;
                    form.submit()
                })
        </script>
    </x-slot>
</x-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <x-frontend.head
        title="{{ @$title }}"
        meta-title="{{ @$metaTitle }}"
        meta-keywords="{{ @$metaKeywords }}"
        meta-description="{{ @$metaDescription }}"
    ></x-frontend.head>
    <x-frontend.styles>
        {{ $style ?? '' }}
    </x-frontend.styles>
</head>
<body>
<button onclick="topFunction()" id="myBtn" title="Go to top">
    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
        <path
            d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3l-137.4 137.4c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25C368.4 348.9 360.2 352 352 352z"/>
    </svg>
</button>

<div class="main_wrapper">
    <x-frontend.header></x-frontend.header>
    <x-frontend.nav></x-frontend.nav>

    <main class="container mx-auto px-2 lg:px-8 sm:px-2">
        {{ $slot }}
    </main>

    <x-frontend.footer></x-frontend.footer>
</div>

<x-frontend.scripts>
    {{ $script ?? '' }}
</x-frontend.scripts>
<script>
    async function getSearchResult(q) {
        return new Promise(function (resolve) {
            $.ajax({
                url: "{{ route('frontend.search.post') }}",
                method: "Post",
                data: {
                    _token: '{{ csrf_token() }}',
                    q
                },
                success: (res => {
                    resolve(res)
                })
            })
        })
    }

    $(document).ready(function () {
        $('#search').on('input', async function () {
            const result = await getSearchResult($(this).val());
            $('#search-result').html(result).show();
            $('.backdrop').show()
        }).on('click', function () {
            $('#search-result').show();
            $('.backdrop').show()
        });

        $('.backdrop').on('click', function () {
            console.log("hi")
            $('#search-result').hide();
            $('.backdrop').hide()
        });
    })
</script>
</body>
</html>

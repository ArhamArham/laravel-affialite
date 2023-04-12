<x-frontend.layout
        title="{{ $page->title }}"
        meta-title="{{ $page->meta_title }}"
        meta-keywords="{{ $page->meta_keywords }}"
        meta-description="{{ $page->meta_description }}"
>

    <div class="py-5">
        <div class="grid grid-cols-12 box">
            <div class="col-span-12 px-2 lg:px-8 sm:px-2">
                <div class="reset">
                    {!! $page->content !!}
                </div>
            </div>

        </div>
    </div>

</x-frontend.layout>

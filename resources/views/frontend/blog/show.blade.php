<x-frontend.layout
    title="Blog"
    meta-title="{{ $blog->meta_title }}"
    meta-keywords="{{ $blog->meta_keywords }}"
    meta-description="{{ $blog->meta_description }}"
>

    <div class="py-5">
        <div class="grid grid-cols-12 box">
            <div class="col-span-6 px-2 lg:px-8 sm:px-2">
                <h4 class="text-xl lg:text-4xl sm:text-xl font-bold mb-3 lg:mb-6 sm:mb-3">{{ $blog->title }}</h4>
                <p class="text-lg lg:text-xl sm:text-lg text-black font-medium my-2 lg:my-6 sm:my-2">
                    {{ $blog->short_description }}
                </p>
                <p class="text-gray-500 text-sm">Updated {{ $blog->updated_at->format('M d, Y') }}</p>
            </div>
            <div class="col-span-6 px-2 lg:px-8 sm:px-2">
                <div class="">
                    <img class="w-full h-full object-contain"
                         src="{{ $blog->getImagePath('image') }}" alt="{{ $blog->image_alt }}">
                </div>
            </div>
            <div class="col-span-12 px-2 pt-5 lg:px-8 sm:px-2">
                <div class="reset">
                    {!! $blog->long_description !!}
                </div>
            </div>

        </div>
    </div>

</x-frontend.layout>

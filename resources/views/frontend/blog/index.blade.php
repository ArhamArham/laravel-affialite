<x-frontend.layout title="Blogs">

    <div class="lg:px-52 sm:px-2 mt-3 lg:mt-6 sm:mt-3">
        <div class="grid grid-cols-12 gap-4 box">
            <div class="col-span-12 px-2 lg:px-8 sm:px-2">
                <h4 class="text-xl lg:text-4xl sm:text-xl font-bold mb-3 lg:mb-6 sm:mb-3">Today Coupons Blog</h4>
            </div>

            <!--Blogs-->
            @foreach($blogs as $blog)
                <div class="col-span-12 px-2 lg:px-8 sm:px-2">
                    <a href="{{ route('frontend.blog.show', $blog->slug) }}">
                        <p class="mb-2 lg:mb-4 sm:mb-2 text-lg lg:text-2xl sm:text-lg font-bold">{{ $blog->title }}</p>
                        <div class="">
                            <img class="w-full h-full object-contain"
                                 src="{{ $blog->getImagePath('image') }}" alt="{{ $blog->image_alt }}">
                        </div>
                        <p class="text-lg lg:text-xl sm:text-lg text-black font-medium my-2 lg:my-6 sm:my-2">
                            {{ $blog->short_description }}
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

</x-frontend.layout>

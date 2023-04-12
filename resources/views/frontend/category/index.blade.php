<x-frontend.layout title="Categories">

    <!--Stores Week-->
    <h3 class="store_heading my-3 mt-3 lg:mt-10 sm:mt-3">VIEW DEALS BY CATEGORIES</h3>
    <div class="grid grid-cols-12 gap-6 mt-4 lg:mt-6 sm:mt-4">
        @forelse($categories as $category)
            <div class="w-full col-span-6 lg:col-span-3 sm:col-span-6 relative">
                <a href="{{ route('frontend.category.show', $category->slug) }}">
                    <div class="brand-box flex justify-center">
                        <img class="category-img w-20 h-20" src="{{ $category->icon_link }}" alt="{{ $category->name }}">
                    </div>
                    <h5 class="mb-2 text-center brand-title cursor-pointer">
                        {{ $category->name }}
                    </h5>
                </a>
            </div>
        @empty
            <div class="w-full col-span-12 lg:col-span-12 sm:col-span-12 relative box mb-0">
                <p class="text-center">No categories found.</p>
            </div>
        @endforelse
    </div>

</x-frontend.layout>

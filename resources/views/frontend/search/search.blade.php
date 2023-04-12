<div class="absolute z-20 w-full h-full" style="display: ">
    <div class="grid grid-cols-12 gap-6 bg-white shadow-lg">
        <div class="col-span-12 mb-4 lg:mb-0 sm:mb-4">
            @forelse($stores as $store)
                <a href="{{ route('frontend.store.show', $store->slug) }}">
                    <div class="grid grid-cols-12 bg-slate-100 m-4 rounded-md">
                        <div class="col-span-2 my-2 ml-5">
                            <img style=""
                                 class="border border-slate-400 h-14 w-14 object-center"
                                 src="{{ $store->image_link }}" alt="{{ $store->name }}"/>
                        </div>
                        <div class="col-span-10 my-2">
                            <h5 class="mb-2 search-title cursor-pointer">
                                {{ $store->name }}
                            </h5>
                        </div>
                    </div>
                </a>
            @empty
                <div class="w-full col-span-12 lg:col-span-12 sm:col-span-12 relative box mb-0">
                    <p class="text-center">No stores found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>


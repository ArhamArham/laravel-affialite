<nav class="primaryNav">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>

                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex">
                        <a href="{{ route('frontend.home') }}"
                           class="nav_link px-5 py-5 @if(request()->route()->getName() == 'frontend.home') route_active @endif"
                           aria-current="page">
                            Home
                        </a>
                        <a href="{{ route('frontend.store.index') }}"
                           class="nav_link px-5 py-5 @if(request()->routeIs('frontend.store.*')) route_active @endif">
                            Featured Stored
                        </a>
                        <a href="{{ route('frontend.category.index') }}"
                           class="nav_link px-5 py-5 @if(request()->routeIs('frontend.category.*')) route_active @endif">
                            Categories
                        </a>
                        <a href="{{ route('frontend.blog.index') }}"
                           class="nav_link px-5 py-5 @if(request()->routeIs('frontend.blog.*')) route_active @endif">
                            Blog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('frontend.home') }}"
               class="nav_link block px-3 py-2 @if(request()->route()->getName() == 'frontend.home') route_active @endif">
                Home
            </a>
            <a href="{{ route('frontend.store.index') }}"
               class="nav_link block px-3 py-2 @if(request()->routeIs('frontend.store.*')) route_active @endif">
                Featured Stored
            </a>
            <a href="{{ route('frontend.category.index') }}"
               class="nav_link block px-3 py-2 @if(request()->routeIs('frontend.category.*')) route_active @endif">
                Categories
            </a>
            <a href="{{ route('frontend.blog.index') }}"
               class="nav_link block px-3 py-2 @if(request()->routeIs('frontend.blog.*')) route_active @endif">
                Blog
            </a>
        </div>
    </div>
</nav>

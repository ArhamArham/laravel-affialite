<div class="bg-white">
    <div class="container max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-2 sm:py-6 lg:py-8">
        <div class="grid grid-cols-12 gap-6 place-items-center">
            <div class="col-span-12 lg:col-span-3 sm:col-span-12 mb-4 lg:mb-0 sm:mb-4">
                @php $logoPath = setting_get('website.headerLogo') @endphp
                <img src="{{ asset("storage/$logoPath") }}" alt="">
            </div>
            <div class="col-span-12 lg:col-span-6 sm:col-span-12 w-full mb-4 lg:mb-0 sm:mb-4 ml-8">
                <div class="relative">
                    <div class="cursor-pointer absolute btn flex inset-y-0 items-center px-4 right-0 text-center z-30">
                        <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2"
                                 viewBox="0 0 24 24" class="w-4 h-4">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                    <input type="search" name="q"
                           id="search"
                           style="position: inherit;"
                           class="header_search w-full py-3 px-2.5 rounded-sm focus:outline-none z-20"
                           placeholder="Enter Keyword Here..." autocomplete="off">

                    <div id="search-result" class="hidden" tabindex="-1">
                        @include('frontend.search.search', ['stores' => collect()])
                    </div>
                    <div class="fixed inset-0 w-full h-screen flex items-center justify-center z-10 backdrop"
                         style="display: none"></div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-3 sm:col-span-12 w-full mb-4 lg:mb-0 sm:mb-4">
                <div class="flex items-start align-items-center justify-center">
                    <a class="icon" href="{{ setting_get('website.facebook_link') }}">
                        <svg class="h-6 w-6 mx-0.5 icon fill-current" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 320 512">
                            <path
                                d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                        </svg>
                    </a>
                    <a class="icon" href="{{ setting_get('website.instagram_link') }}">
                        <svg class="h-6 w-6 mx-0.5 icon fill-current" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 448 512">
                            <path
                                d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                        </svg>
                    </a>
                    <a class="icon" href="{{ setting_get('website.linkedin_link') }}">
                        <svg class="h-6 w-6 mx-0.5 icon fill-current" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 448 512">
                            <path
                                d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                        </svg>
                    </a>
                    <a class="icon" href="{{ setting_get('website.pinterest_link') }}">
                        <svg class="h-6 w-6 mx-0.5 icon fill-current" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 496 512">
                            <path
                                d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<x-frontend.layout>

    <x-slot name="style">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    </x-slot>

    <!-- Carousel & SideBar -->
    <div class="grid grid-cols-12 gap-6 mt-4 lg:mt-10 sm:mt-4">
        <div class="w-full col-span-12 lg:col-span-3 sm:col-span-12">
            <aside>
                <ul class="panel">

                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('frontend.category.show',$category->slug) }}"
                               class="flex items-center aside_link">
                                <img src="{{ $category->icon_link }}" class="w-4 h-4 mx-2" alt="">
                                {{ $category->name }}
                                <span>{{ $category->stores_count }}</span>
                            </a>
                        </li>
                    @endforeach

                    <li class="px-3">
                        <a href="{{ route('frontend.category.index') }}" class="flex items-center aside_link">
                            All Categories
                        </a>
                    </li>

                </ul>
            </aside>
        </div>

        <div class="relative slick-slider w-full col-span-12 lg:col-span-9 sm:col-span-12">
            <img src="{{ asset('frontend/img/banner-01.jpg') }}" alt="">
            <img src="https://www.codeswodes.com/images/slider/tidestore.jpg" alt="">
        </div>
    </div>

    <!-- Category -->
    <div class="grid grid-cols-12 gap-6 mt-4 lg:mt-10 sm:mt-4">
        <div class="w-full col-span-12 lg:col-span-4 sm:col-span-12">
            <div class="grid grid-cols-3 gap-2 box">
                <div class="w-full col-span-3 lg:col-span-1 sm:col-span-3">
                    <img src="{{ asset('frontend/img/tablet.png') }}" class="h-24 w-24 block mx-auto" alt="">
                </div>
                <div class="w-full col-span-3 lg:col-span-2 sm:col-span-3">
                    <h5 class="mb-2">Deals &amp; Coupons</h5>
                    <p class="color-mid">We gather reliable deals and coupons to bring you hassle free shopping
                        experience.
                    </p>
                </div>
            </div>
        </div>
        <div class="w-full col-span-12 lg:col-span-4 sm:col-span-12">
            <div class="grid grid-cols-3 gap-2 box">
                <div class="w-full col-span-3 lg:col-span-1 sm:col-span-3">
                    <img src="{{ asset('frontend/img/basket.png') }}" class="h-24 w-24 block mx-auto" alt="">
                </div>
                <div class="w-full col-span-3 lg:col-span-2 sm:col-span-3">
                    <h5 class="mb-2">Find Best Offers</h5>
                    <p class="color-mid">
                        You can find almost every deal of any category , brand you like most.
                    </p>
                </div>
            </div>
        </div>
        <div class="w-full col-span-12 lg:col-span-4 sm:col-span-12">
            <div class="grid grid-cols-3 gap-2 box">
                <div class="w-full col-span-3 lg:col-span-1 sm:col-span-3">
                    <img src="{{ asset('frontend/img/money.png') }}" class="h-24 w-24 block mx-auto" alt="">
                </div>
                <div class="w-full col-span-3 lg:col-span-2 sm:col-span-3">
                    <h5 class="mb-2">Save Money</h5>
                    <p class="color-mid">
                        Saving time is a great achievement but Saving Money is remarkable.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Week Coupons -->
    <div class="flex justify-center items-center lg:justify-between box mt-4 lg:mt-6 sm:mt-4">
        <div class="mr-12">
            <h3 class="section-title">Top This Week Coupons</h3>
        </div>
        <div class="flex justify-center">
            <a href="{{ route('frontend.store.index') }}" class="section-btn">View All</a>
        </div>
    </div>

    <div class="mt-4 lg:mt-6 sm:mt-4 slick-coupon">
        @foreach($coupons as $coupon)
            <div class="w-full mx-2 box relative">
                <div class="ribbon-wrapper">
                    <div class="ribbon">Featured</div>
                </div>
                <div class="">
                    <img class="Product-img" src="{{ $coupon->store->image_link }}"
                         alt="{{ $coupon->store->image_alt }}">
                </div>
                <div class="my-2 flex items-center justify-center badge">
                    <svg class="w-4 h-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M256 352C293.2 352 319.2 334.5 334.4 318.1C343.3 308.4 358.5 307.7 368.3 316.7C378 325.7 378.6 340.9 369.6 350.6C347.7 374.5 309.7 400 256 400C202.3 400 164.3 374.5 142.4 350.6C133.4 340.9 133.1 325.7 143.7 316.7C153.5 307.7 168.7 308.4 177.6 318.1C192.8 334.5 218.8 352 256 352zM208.4 208C208.4 225.7 194 240 176.4 240C158.7 240 144.4 225.7 144.4 208C144.4 190.3 158.7 176 176.4 176C194 176 208.4 190.3 208.4 208zM304.4 208C304.4 190.3 318.7 176 336.4 176C354 176 368.4 190.3 368.4 208C368.4 225.7 354 240 336.4 240C318.7 240 304.4 225.7 304.4 208zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/>
                    </svg>
                    Verified
                </div>
                <h5 class="mb-2 text-center title">
                    <a href="#">{{ $coupon->offer_box }}</a>
                </h5>
                <div class="flex items-baseline text-sm justify-center my-2 color-mid">
                    <svg class="fill-current color-mid h-4 w-4 mx-1" version="1.1" xmlns="http://www.w3.org/2000/svg"
                         width="20" height="20" viewBox="0 0 20 20">
                        <path fill="#000000"
                              d="M16.32 17.113c1.729-1.782 2.68-4.124 2.68-6.613 0-2.37-0.862-4.608-2.438-6.355l0.688-0.688 0.647 0.646c0.098 0.098 0.226 0.146 0.353 0.146s0.256-0.049 0.353-0.146c0.195-0.195 0.195-0.512 0-0.707l-2-2c-0.195-0.195-0.512-0.195-0.707 0s-0.195 0.512 0 0.707l0.647 0.646-0.688 0.688c-1.747-1.576-3.985-2.438-6.355-2.438s-4.608 0.862-6.355 2.438l-0.688-0.688 0.646-0.646c0.195-0.195 0.195-0.512 0-0.707s-0.512-0.195-0.707 0l-2 2c-0.195 0.195-0.195 0.512 0 0.707 0.098 0.098 0.226 0.146 0.354 0.146s0.256-0.049 0.354-0.146l0.646-0.646 0.688 0.688c-1.576 1.747-2.438 3.985-2.438 6.355 0 2.489 0.951 4.831 2.68 6.613l-2.034 2.034c-0.195 0.195-0.195 0.512 0 0.707 0.098 0.098 0.226 0.147 0.354 0.147s0.256-0.049 0.354-0.147l2.060-2.059c1.705 1.428 3.836 2.206 6.087 2.206s4.382-0.778 6.087-2.206l2.059 2.059c0.098 0.098 0.226 0.147 0.354 0.147s0.256-0.049 0.353-0.147c0.195-0.195 0.195-0.512 0-0.707l-2.034-2.034zM1 10.5c0-4.687 3.813-8.5 8.5-8.5s8.5 3.813 8.5 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5z">
                        </path>
                        <path fill="#000000"
                              d="M15.129 7.25c-0.138-0.239-0.444-0.321-0.683-0.183l-4.92 2.841-3.835-2.685c-0.226-0.158-0.538-0.103-0.696 0.123s-0.103 0.538 0.123 0.696l4.096 2.868c0.001 0.001 0.002 0.001 0.002 0.002 0.009 0.006 0.018 0.012 0.027 0.017 0.002 0.001 0.004 0.003 0.006 0.004 0.009 0.005 0.018 0.010 0.027 0.015 0.002 0.001 0.004 0.002 0.006 0.003 0.010 0.005 0.020 0.009 0.031 0.014 0.006 0.003 0.013 0.005 0.019 0.007 0.004 0.001 0.008 0.003 0.013 0.005 0.007 0.002 0.014 0.004 0.021 0.006 0.004 0.001 0.008 0.002 0.012 0.003 0.007 0.002 0.014 0.003 0.022 0.005 0.004 0.001 0.008 0.002 0.012 0.002 0.007 0.001 0.014 0.002 0.021 0.003 0.005 0.001 0.010 0.001 0.015 0.002 0.006 0.001 0.012 0.001 0.018 0.002 0.009 0.001 0.018 0.001 0.027 0.001 0.002 0 0.004 0 0.006 0 0 0 0-0 0-0s0 0 0.001 0c0.019 0 0.037-0.001 0.056-0.003 0.001-0 0.002-0 0.003-0 0.018-0.002 0.036-0.005 0.054-0.010 0.002-0 0.003-0.001 0.005-0.001 0.017-0.004 0.034-0.009 0.050-0.015 0.003-0.001 0.006-0.002 0.008-0.003 0.016-0.006 0.031-0.012 0.046-0.020 0.004-0.002 0.007-0.004 0.011-0.006 0.005-0.003 0.011-0.005 0.016-0.008l5.196-3c0.239-0.138 0.321-0.444 0.183-0.683z">
                        </path>
                    </svg>
                    Expires On {{ $coupon->expiry_date }}
                </div>
                <div class="mx-auto w-full text-center my-2 lg:my-8 sm:my-2">
                    <a href="{{ route('frontend.store.show', $coupon->store->slug) }}" class="coupn_btn">See Coupons</a>
                </div>
            </div>
        @endforeach
    </div>

    <!--Stores Week-->
    <div class="flex justify-center items-center lg:justify-between box mt-4 lg:mt-6 sm:mt-4">
        <div class="mr-12 hidden lg:block">
            <h3 class="section-title">Stores Of The Week</h3>
        </div>
        <div class="flex justify-center">
            <a href="{{ route('frontend.store.index') }}" class="section-btn">All Stores</a>
        </div>
    </div>

    <div class="mt-4 lg:mt-6 sm:mt-4 slick-store">
        @foreach($stores as $store)
            <div class="w-full mx-2 relative">
                <a href="{{ route('frontend.store.show', $store->slug)  }}">
                    <div class="brand-box flex justify-center">
                        <img class="home-store-img" src="{{ $store->image_link }}" alt="{{ $store->image_alt }}">
                    </div>
                    <h5 class="mb-2 text-center brand-title cursor-pointer">
                        {{ $store->name }}
                    </h5>
                </a>
            </div>
        @endforeach
    </div>

    <x-slot name="script">
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script>

            $(document).ready(function () {
                $('.slick-slider').slick({
                    arrows: false
                })

                $('.slick-coupon').slick({
                    arrows: false,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });

                $('.slick-store').slick({
                    arrows: false,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 6,
                    slidesToScroll: 6,
                    // autoplay: true,
                    // autoplaySpeed: 3000,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        }
                    ]
                });
            });

        </script>
    </x-slot>

</x-frontend.layout>

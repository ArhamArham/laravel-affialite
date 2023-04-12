<footer class="text-center lg:text-left bg-white text-gray-600 mt-2 lg:mt-6 sm:mt-2">
    <div class=" container mx-auto px-2 lg:px-8 sm:px-2">
        <div class="flex items-center justify-between py-2 lg:py-6 sm:py-2 grid grid-cols-12 gap-4">
            <div class="p-2 lg:p-6 sm:p-2 w-full lg:w-72 sm:w-full col-span-12 lg:col-span-4 sm:col-span-12">
                <a href="https://www.today-coupons.com/" class="logo">
                    @php $logoPath = setting_get('website.headerLogo') @endphp
                    <img src="{{ asset("storage/$logoPath") }}" alt="">
                </a>
                <p class="color-mid">
                    {{ setting_get('website.footerText') }}
                </p>
            </div>
            <div class="w-full lg:w-96 sm:w-full col-span-12 lg:col-span-8 sm:col-span-12 ml-auto">
                <div class="flex items-center justify-between">
                    <div class="footer-links">
                        <h2 class="px-2">Quick Links</h2>
                        <ul>
                            <li>
                                <a href="{{ route('frontend.blog.index') }}" class="flex items-center foot_link">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 256 512">
                                        <path
                                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/>
                                    </svg>
                                    Blogs
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.page', 'terms-and-condition') }}"
                                   class="flex items-center foot_link">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 256 512">
                                        <path
                                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/>
                                    </svg>
                                    Terms &amp; Condition
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.page', 'about-us') }}" class="flex items-center foot_link">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 256 512">
                                        <path
                                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/>
                                    </svg>
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.page', 'privacy-policy') }}"
                                   class="flex items-center foot_link">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 256 512">
                                        <path
                                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/>
                                    </svg>
                                    Privacy Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links">
                        <h2 class="px-2">Social</h2>
                        <ul>
                            <li>
                                <a href="{{ setting_get('website.facebook_link') }}"
                                   class="flex items-center foot_link">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 256 512">
                                        <path
                                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/>
                                    </svg>
                                    Facebook
                                </a>
                            </li>
                            <li>
                                <a href="{{ setting_get('website.pinterest_link') }}"
                                   class="flex items-center foot_link">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 256 512">
                                        <path
                                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/>
                                    </svg>
                                    Pinterest
                                </a>
                            </li>
                            <li>
                                <a href="{{ setting_get('website.instagram_link') }}"
                                   class="flex items-center foot_link">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 256 512">
                                        <path
                                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/>
                                    </svg>
                                    Instagram
                                </a>
                            </li>
                            <li>
                                <a href="{{ setting_get('website.linkedin_link') }}"
                                   class="flex items-center foot_link">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 256 512">
                                        <path
                                                d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z"/>
                                    </svg>
                                    Linkedin
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center p-6 bgFoot">
        <span>Copyright © TodayCoupons 2022 . All rights reserved. Contact info@todaycoupons.com </span>
    </div>
</footer>

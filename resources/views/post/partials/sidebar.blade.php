<!-- Sidebar Section -->
<aside class="w-full md:w-1/3 flex flex-col items-center px-3">

    <div class="w-full bg-white dark:bg-gray-800 rounded-lg shadow flex flex-col my-4 p-6 dark:text-gray-400">
        <p class="text-xl font-semibold pb-5 dark:text-gray-200">{{ __('content.about') }}</p>
        <p class="pb-2">{{ __('content.about-content') }}</p>
        <a href="{{ route('about') }}"
            class="w-full bg-sky-600 text-white font-bold text-sm normal-case rounded hover:bg-sky-700 flex items-center justify-center px-2 py-3 mt-4">
            {{ __('content.us') }}
        </a>
    </div>

    <div class="w-full bg-white dark:bg-gray-800 rounded-lg shadow flex flex-col my-4 p-6">
        <p class="text-xl font-semibold pb-5 dark:text-gray-200">Facebook</p>
        <a type="button" data-te-ripple-init data-te-ripple-color="light"
            href="https://www.facebook.com/FablabSolidaireMamiratra"
            target="_blank" class="w-full bg-sky-600 text-white font-bold text-sm normal-case rounded hover:bg-sky-700 flex items-center justify-center px-2 py-3 mt-6">
            <p><i class="fab fa-facebook mr-2"></i>{{ __('content.follow') }} @fablab</p>
        </a>
    </div>

</aside>
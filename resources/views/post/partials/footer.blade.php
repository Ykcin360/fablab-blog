<footer class="w-full border-t dark:border-gray-700 bg-white pb-12 dark:bg-gray-800 dark:text-gray-200">
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="flex flex-col space-y-5 md:space-y-0 md:flex-row text-center md:text-left md:justify-between py-6">
            <a href="{{ route('about') }}" class="uppercase px-3 hover:text-sky-600 transition-colors ease-in">{{ __('footer.about') }}</a>
            <a href="{{ route('privacy') }}" class="uppercase px-3 hover:text-sky-600 transition-colors ease-in">{{ __('footer.privacy') }}</a>
            <a href="{{ route('terms') }}" class="uppercase px-3 hover:text-sky-600 transition-colors ease-in">{{ __('footer.terms-conditions') }}</a>
            <a href="{{ route('contact') }}" class="uppercase px-3 hover:text-sky-600 transition-colors ease-in">{{ __('footer.contact') }}</a>
        </div>
        <div class="uppercase">{{ config('app.name', 'Laravel') }} &copy; {{ date('Y') }}</div>
    </div>
</footer>
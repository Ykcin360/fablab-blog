<x-app-layout>
    <x-slot name="header">
        <form class="flex justify-center w-full" method="get" action="{{ route('search') }}">
            <input type="text" class="w-full border-none dark:bg-gray-800 rounded-lg" name="q" placeholder="{{ __('content.search-ph') }}">
            <button type="submit" class="rounded-md"></button>
        </form>
    </x-slot>

    <!-- Text Header -->
    <header class="w-full container mx-auto ">
        <div class="flex flex-col items-center py-12">
            <p class="font-bold text-gray-800 dark:text-gray-200 uppercase text-5xl" href="#">
                Fablab Blog
            </p>
            <p class="text-lg text-gray-500">
                {{ __('content.welcome') }}
            </p>
        </div>
    </header>

    <!-- Post Section -->
    @livewire('post-section')

    @include('post.partials.footer')
</x-app-layout>    
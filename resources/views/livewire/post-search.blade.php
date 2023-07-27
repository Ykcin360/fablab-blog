<div wire:init="loadData">
    <header class="bg-white shadow dark:bg-gray-800">
        <div class="flex mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <input type="text" class="w-full border-none dark:bg-gray-800 rounded-lg" value="{{ $q }}"
            placeholder="{{ __('content.search-ph') }}" wire:model.debounce.1000ms="search" wire:keydown.debounce.500ms="loadData()">
            @if (!empty($search))
            <button wire:click="$set('search', '')" class="mx-2">
                <i class="fa fa-times"></i>
            </button>
            @endif
        </div>
    </header>

    <!-- Text Header -->
    <header class="w-full container mx-auto ">
        <div class="flex flex-col items-center py-12">
            <p class="font-bold text-gray-800 dark:text-gray-200 uppercase text-5xl" href="#">
                Fablab Blog
            </p>
            <p class="text-lg text-gray-500">
                {{ __('content.search-result') }}
            </p>
        </div>
    </header>

    @isset($posts)
        <!-- Post List -->
        <div class="px-12 text-gray-500">
            @forelse ($posts as $post)
                @if($post->user != null)
                <a href="{{ route('posts.show', $post) }}"
                    class="flex md:flex-row flex-col justify-between bg-white dark:bg-gray-800 py-4 px-12 rounded-lg shadow hover:bg-sky-500 hover:text-gray-100 ease-out duration-100 mb-6">
                    <div class="flex md:flex-row flex-col md:space-x-6">
                        <div><i class="fi fi-rr-user"></i> {{ $post->user->name }}</div>
                        <div><i class="fi fi-rr-browser"></i> {{ $post->title }}</div>
                    </div>
                    <div class="text-sm">{{ Str::limit($post->content, 100) }}</div>
                </a>
                @endif
            @empty
            <div class="text-center text-xl">
                {{ __('content.search-noresult') }}
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @else
        <div class="px-12 text-gray-500">
            <div class="animate-pulse flex justify-between bg-white dark:bg-gray-800 py-6 px-12 rounded-lg shadow hover:bg-sky-500 hover:text-gray-100 ease-out duration-100 mb-6"></div>
        </div>
    @endisset
<div>
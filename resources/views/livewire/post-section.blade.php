<div wire:init="loadCardData">
  <!-- Topic Nav -->
  <nav class="w-full bg-gray-100 py-4 text-gray-800 dark:bg-gray-800 dark:text-gray-200" x-data="{ open: false }">
    <div class="block sm:hidden">
      <a href="#" class="flex items-center justify-center text-center text-base font-extrabold uppercase md:hidden"
        @click="open = !open">
        Topics <i :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" class="fas ml-2"></i>
      </a>
    </div>
    <div :class="open ? 'block' : 'hidden'" class="w-full flex-grow sm:flex sm:w-auto sm:items-center">
      <div
        class="container mx-auto mt-0 flex w-full flex-col items-center justify-center px-6 py-2 text-sm font-bold uppercase sm:flex-row">
        @isset($categories)
        <a class="{{ $categoryFilter === null ? 'bg-sky-600 text-gray-200' : '' }} mx-2 cursor-pointer rounded py-2 px-4 hover:bg-sky-600 hover:text-gray-200"
          wire:click.delay="resetCategoryFilter()">{{ __('content.all') }}</a>
        @foreach ($categories as $id => $name)
        <a class="{{ $categoryFilter === $id ? 'bg-sky-600 text-gray-200' : '' }} mx-2 cursor-pointer rounded py-2 px-4 hover:bg-sky-600 hover:text-gray-200"
          wire:key="cat-{{ $id }}" wire:click.delay="filterByCategory({{ $id }})">{{ $name }}</a>
        @endforeach
        @else
        <div
          class="container mx-auto mt-0 flex w-full items-center justify-center px-6 text-sm font-bold uppercase sm:flex-row">
          <div class="animate-pulse flex space-x-8">
            <div class=" h-10 dark:bg-slate-700 bg-slate-300 rounded w-14"></div>
            <div class=" h-10 dark:bg-slate-700 bg-slate-300 rounded w-24"></div>
            <div class=" h-10 dark:bg-slate-700 bg-slate-300 rounded w-24"></div>
            <div class=" h-10 dark:bg-slate-700 bg-slate-300 rounded w-32"></div>
            <div class=" h-10 dark:bg-slate-700 bg-slate-300 rounded w-20"></div>
          </div>
        </div>
        @endisset
      </div>
    </div>
  </nav>

  <!-- Posts -->
  <div class="container mx-auto flex flex-wrap py-3">

    @isset($posts)
    <section class="flex w-full flex-col items-center px-3 md:w-2/3">

      <!-- Articles -->
      @forelse ($posts as $post)
      <article class="my-4 flex w-full flex-col rounded-lg bg-gray-300 shadow dark:bg-gray-700"
        wire:key='post-{{ $post->id }}'>

        <!-- Article Body -->
        <div class="flex flex-col justify-start rounded-t-lg bg-white p-6 dark:bg-gray-800">
          <div class="flex justify-between align-top">
            <a class="cursor-pointer pb-4 text-sm font-bold uppercase text-sky-600"
              wire:click="filterByCategory({{ $post->category->id }})">{{ $post->category->name }}</a>
            @auth
            @if (Auth::user()->id == $post->user->id)
            <x-dropdown align="right" width="48">
              <x-slot name="trigger">
                <button
                  class="inline-flex items-center rounded-md border border-transparent  px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:text-gray-400 dark:hover:text-gray-300">
                  <div>{{ __('content.settings') }}</div>

                  <div class="ml-1">
                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                </button>
              </x-slot>

              <x-slot name="content">
                <!-- Edit Post -->
                <x-dropdown-link :href="route('posts.edit', $post)">
                  {{ __('content.edit') }}
                </x-dropdown-link>

                <!-- Delete Post -->
                <form method="POST" action="{{ route('posts.delete', $post) }}">
                  @csrf
                  @method('delete')
                  <input type="hidden" name="category" value="{{ $post->category->id }}">
                  <x-dropdown-link :href="route('posts.delete', $post)" onclick="event.preventDefault();
                                  this.closest('form').submit();">
                    {{ __('content.delete') }}
                  </x-dropdown-link>
                </form>
              </x-slot>
            </x-dropdown>
            @endif
            @endauth
          </div>
          <p class="pb-4 text-3xl font-bold dark:text-gray-200">{{ $post->title }}</p>
          <p class="text-sm pb-3 dark:text-gray-400">
            {{ __('content.by') }} <a href="{{ route('profile.index', $post->user->id) }}"
              class="font-semibold hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-500 hover:underline">{{
              $post->user->name }}</a>, {{ __('content.publish') }} {{
            $post->created_at->format(__('content.date-format')) }}
          </p>
          <p class="pb-6 dark:text-gray-400">{{ Str::limit($post->content, 100) }}</p>
          @auth
          <a href="{{ route('posts.show', $post) }}"
            class="lowercase w-1/2 text-gray-800 hover:text-sky-500 dark:text-gray-400">{{
            __('content.see-more') }} <i class="fas fa-arrow-right"></i></a>
          @endauth
        </div>

        <!-- Article Image -->
        @if ($post->image)
        <a href="{{ route('posts.show', $post) }}" class="max-h-80 max-w-screen-sm self-center hover:opacity-75">
          <img class="h-full" src="{{ asset('/storage/' . $post->image) }}" alt="Blog Image">
        </a>
        @else
        <div class="h-10 bg-white dark:bg-gray-700"></div>
        @endif
        
        <div class="flex flex-col justify-start rounded-b-lg bg-white p-6 dark:bg-gray-800">
          @auth()
          @livewire('post-reaction', ['postId' => $post->id], key('post-reaction-' . $post->id))
          @endauth
        </div>
      </article>
      @empty
      <div
        class="my-4 flex w-full flex-col justify-start rounded bg-white p-6 shadow-gray-800 drop-shadow-lg dark:bg-gray-800 dark:text-gray-200">
        {{ __('content.no-post') }}
      </div>
      @endforelse

      <!-- Pagination -->
      @auth()
      <div class="my-4 w-full" wire:click="loadCardData">
        {{ $posts->links() }}
      </div>
      @else
      <div class="mt-6 text-center font-semibold dark:text-gray-200">
        {{ __('content.auth.p1') }}
        <a href="{{ route('login') }}" class="text-sky-600">{{ __('content.auth.p2') }}</a> {{ __('content.auth.p3') }}
        <a href="{{ route('register') }}" class="text-sky-600">{{ __('content.auth.p4') }}</a>
        {{ __('content.auth.p5') }}
      </div>
      @endauth

    </section>
    @else
    <section class="flex w-full flex-col items-center px-3 md:w-2/3">
      <article class="my-4 flex w-full flex-col rounded-lg bg-slate-300 shadow dark:bg-gray-700 animate-pulse">
        <div class="flex-col justify-start rounded-t-lg p-6 space-y-6 bg-white dark:bg-gray-800">
          <div class="flex justify-between align-top mb-6">
            <div class="h-4 bg-slate-300 dark:bg-slate-700 rounded w-20"></div>
          </div>
          <div class="pb-3 h-6 bg-slate-300 dark:bg-slate-700 rounded w-80"></div>
          <div class="pb-3 h-2 bg-slate-300 dark:bg-slate-700 rounded w-72"></div>
          <div class="pb-3 h-2 bg-slate-300 dark:bg-slate-700 rounded w-[70%]"></div>
        </div>
        <div class="h-96"></div>
      </article>
    </section>
    @endisset

    <!-- Sidebar Section -->
    @include('post.partials.sidebar')

  </div>
</div>
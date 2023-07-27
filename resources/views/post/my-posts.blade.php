<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('navigation.user-posts') }}
    </h2>
  </x-slot>

  <div class="min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        @if (session('success'))
        <div class="p-6 text-gray-900 dark:text-gray-100">
          {{ session('success') }}
        </div>
        @endif
      </div>

      <div class=" overflow-hidden sm:rounded-lg mb-6">
        <!-- Pagination -->
        @auth()
        <div class="my-4 w-full">
          {{ $posts->links() }}
        </div>
        @endauth

        <div class="text-gray-900 dark:text-gray-100">
          @forelse ($posts as $post)
          <article class="flex flex-col shadow my-6 w-full rounded bg-gray-300 dark:bg-gray-700">
            <!-- Article Body -->
            <div class="bg-white dark:bg-gray-800 flex flex-col justify-start p-6 rounded">
              <!-- Article Category & Settings -->
              <div class="flex justify-between align-top">
                <div class="text-sky-600 text-sm font-bold uppercase pb-4">{{ $post->category->name }}</div>
                <x-dropdown align="right" width="48">
                  <x-slot name="trigger">
                    <button
                      class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                      <div>{{ __('content.settings') }}</div>

                      <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
              </div>
              <!-- Article Title -->
              <p class="text-3xl dark:text-gray-200 font-bold pb-4">{{ $post->title }}</p>
              <!-- Article Author & Date -->
              <p href="#" class="text-sm pb-3 dark:text-gray-400">
                {{ __('content.by') }} <a href="{{ route('profile.index', $post->user->id) }}"
                  class="font-semibold hover:text-gray-800 dark:text-gray-400 hover:dark:text-gray-500 hover:underline">{{
                  $post->user->name }}</a>, {{ __('content.publish') }} {{ $post->created_at->format(__('content.date-format')) }}
              </p>
              <!-- Article Content -->
              <p class="pb-6 dark:text-gray-400">{{ Str::limit($post->content, 100) }}</p>
              <a href="{{ route('posts.show', $post) }}"
                class="lowercase text-gray-800 hover:text-sky-500 dark:text-gray-400">{{ __('content.see-more') }} <i class="fas fa-arrow-right"></i></a>
            </div>
            <!-- Article Image -->
            @if ($post->image != null)
            <a href="{{ route('posts.show', $post) }}" class="hover:opacity-75 self-center max-w-screen-sm h-96">
              <img class="h-full object-contain" src="{{ asset('/storage/'.$post->image) }}" alt="Blog Image">
            </a>
            @endif

            <div class="flex flex-col justify-start rounded-b-lg bg-white p-6 dark:bg-gray-800">
              @auth()
              @livewire('post-reaction', ['postId' => $post->id], key('post-reaction-' . $post->id))
              @endauth
            </div>

          </article>
          @empty
          <div class="bg-white dark:bg-gray-800 flex flex-col justify-start p-6 drop-shadow-sm shadow-gray-800 rounded">
            {{ __('content.no-post') }}
          </div>
          @endforelse
        </div>

        <!-- Pagination -->
        @auth()
        {{ $posts->links() }}
        @else
        <div class="text-center dark:text-gray-200 font-semibold">
          {{ __('content.auth.p1') }}
          <a href="{{ route('login') }}" class="text-sky-600">{{ __('content.auth.p2') }}</a> {{
          __('content.auth.p3') }}
          <a href="{{ route('register') }}" class="text-sky-600">{{ __('content.auth.p4') }}</a>
          {{ __('content.auth.p5') }}
        </div>
        @endauth
      </div>
    </div>
  </div>

  @include('post.partials.footer')
</x-app-layout>
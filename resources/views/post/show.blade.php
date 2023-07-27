<x-app-layout>
  <x-modal name="post-img" focusable>
    <div class="h-[92vh] flex justify-center">
      <img class="mx-auto object-contain" src="{{ asset('/storage/' . $post->image) }}" alt="Blog Image">
    </div>
  </x-modal>

  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 capitalize">
      {{ __('navigation.show-post') }} {{ $post->user != null ? $post->user->name : "( User Deleted )" }} - {{ $post->category->name }}
    </h2>
  </x-slot>

  <!-- Post -->
  <div
    class="my-6 mx-auto flex flex-col items-start rounded-xl bg-white dark:bg-gray-800 md:max-w-5xl md:flex-row md:py-6">
    <!--Left Col-->
    <div class="flex w-full flex-col items-start justify-center px-6 pt-6 pb-6 lg:w-1/2">
      <div class="flex w-full justify-between">
        <a href="{{ route('post.index') }}"
          class="rounded-full px-2 text-gray-500 transition-colors duration-200 hover:text-gray-600 dark:hover:text-gray-200">
          <i class="fi fi-rr-home"></i>
        </a>
        @if ($post->user != null && Auth::user()->id == $post->user->id)
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button
                class="inline-flex items-center rounded-md border border-transparent px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:text-gray-400 dark:hover:text-gray-300">
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
              {{-- <form method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('delete')

                            <x-dropdown-link :href="route('posts.destroy',  $post)" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Delete') }}
                            </x-dropdown-link>
                        </form> --}}
              <!-- Delete Post -->
              <form method="POST" action="{{ route('posts.delete', $post) }}">
                @csrf
                @method('delete')
                <input type="hidden" name="category" value="{{ $post->category->id }}">
                <x-dropdown-link :href="route('posts.delete', $post)"
                  onclick="event.preventDefault();
                                                this.closest('form').submit();">
                  {{ __('content.delete') }}
                </x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
        @endif
      </div>
      <h1 class="title-font mb-4 text-2xl font-medium text-gray-900 dark:text-gray-200 sm:text-2xl">{{ $post->title }}
      </h1>
      <p title="{{ $post->created_at }}" class="cursor-pointer pb-4 text-sm italic text-gray-500 dark:text-gray-400">
        {{ $post->created_at }} ({{ $post->created_at->diffForHumans() }})</p>
      <x-textarea id="content" class="mt-1 block h-96 w-full resize-none py-2" name="content" :value="old('content')"
        :content="$post->content" readonly autofocus />
    </div>
    <!--Right Col-->
    <div class="w-full lg:w-1/2 lg:py-6">

      <!-- Post Reactions -->
      <div class="flex flex-col rounded-b-lg bg-white p-6 dark:bg-gray-800">
        @livewire('post-reaction', ['postId' => $post->id])
      </div>

      <!-- Post Image -->
      @if ($post->image != null)
        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'post-img')"
          class="h-80 max-w-screen-sm self-center hover:opacity-75">
          <img class="mx-auto object-cover object-center p-6 hover:opacity-80" alt="Blog Image"
            src="{{ asset('/storage/' . $post->image) }}">
        </button>
      @endif
      
    </div>
  </div>

  <!-- Comments -->
  @livewire('comment-section', ['postId' => $post->id])
</x-app-layout>

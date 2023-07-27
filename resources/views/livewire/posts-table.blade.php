<div>
  <!-- Search Bar -->
  <div class="relative my-6 flex w-full items-center pl-1 sm:ml-0 sm:pr-2">
    <div class="container relative left-0 z-50 flex">
      <div class="group relative flex w-full items-center">
        <div
          class="absolute z-50 flex h-10 w-auto cursor-pointer items-center justify-center p-3 pr-2 text-sm uppercase text-gray-500 sm:hidden">
          <svg fill="none" class="relative h-5 w-5" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            stroke="currentColor" viewBox="0 0 24 24">
            <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
            </path>
          </svg>
        </div>
        <svg
          class="pointer-events-none absolute left-0 z-20 ml-4 hidden h-4 w-4 fill-current text-gray-500 group-hover:text-gray-400 sm:block"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
          </path>
        </svg>
        <!-- Search Input -->
        <input type="text"
          class="aa-input block w-full rounded-2xl bg-gray-100 py-1.5 pl-10 pr-4 leading-normal text-gray-600 ring-opacity-90 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-sky-500 dark:bg-gray-800 dark:text-gray-300"
          placeholder="{{ __('content.search') }}" wire:model.debounce.1000ms="search">
      </div>
    </div>
  </div>

  <!-- posts List -->
  <div class="mb-6 md:flex-col items-center justify-around">
    <div class="table h-full w-full text-sm">
      <div class="table-column rounded-md text-gray-800 dark:bg-gray-800 dark:text-gray-200 md:table-header-group">
        <div class="table-cell px-4 py-2 font-bold">{{ __('data.table.title') }}</div>
        <div class="table-cell px-4 py-2 font-bold">{{ __('data.table.owner') }}</div>
        <div class="table-cell px-4 py-2 font-bold">{{ __('data.table.category') }}</div>
        <div class="table-cell px-4 py-2 font-bold">{{ __('data.table.created-at') }}</div>
        <div class="table-cell px-4 py-2 font-bold">{{ __('data.table.reactions') }}</div>
        <div class="table-cell px-4 py-2 font-bold">Actions</div>
      </div>
      <div class="table-row-group">
        <!-- Post details -->
        @foreach ($posts as $post)
          <div
            class="table-row border-b border-gray-200 bg-white text-slate-600 hover:text-sky-500 dark:bg-gray-600 dark:text-gray-200 dark:hover:text-sky-300 md:border-none">
            <a href="{{ route('posts.show', $post->id) }}" class="h-16 border-b-2 px-4 py-2 font-medium md:table-cell block">
              {{ $post->title }}
            </a>
            <div class="h-16 border-b-2 px-4 py-2 md:table-cell">
              @if ($post->user == null)
                  ( User Deleted )
              @else
                  {{ $post->user->name }}
              @endif
            </div>
            <div class="h-16 border-b-2 px-4 py-2 md:table-cell capitalize">
              {{ $post->category->name }}
            </div>
            <div class="h-16 border-b-2 px-4 py-2 md:table-cell">
              {{ $post->created_at }}
            </div>
            <div class="h-16 border-b-2 px-4 py-2 md:table-cell">
              {{ $post->reactions->count() }}
            </div>
            <div class="mb-20 flex h-16 items-center space-x-4 border-b-2 px-4 md:table-cell md:py-2">
              <a href="{{ route('posts.edit', $post) }}" type="button" class="hover:text-yellow-500"
                title="Edit This post">
                <i class="fi fi-rr-edit"></i>
              </a>
              <button type="button" class="hover:text-red-500" title="Delete This post"
                wire:click="deletePost({{ $post->id }}, {{ $post->category->id }})">
                <i class="fi fi-rr-trash"></i>
              </button>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 w-full">
      {{ $posts->links() }}
    </div>
  </div>
</div>

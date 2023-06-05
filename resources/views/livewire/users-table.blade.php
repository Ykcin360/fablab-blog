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
          class="block w-full rounded-2xl bg-gray-100 py-1.5 pl-10 pr-4 leading-normal text-gray-600 ring-opacity-90 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-sky-500 dark:bg-gray-800 dark:text-gray-300"
          placeholder="{{ __('content.search') }}" wire:model.debounce.1000ms="search">
      </div>
    </div>
  </div>

  <!-- Posts List -->
  <div class="mb-6 flex-col items-center justify-around">
    <div class="table h-full w-full text-sm">
      <div class="table-column text-gray-800 dark:bg-gray-800 dark:text-gray-200 md:table-header-group">
        <div class="table-cell px-4 py-2 font-bold rounded-tl-lg">{{ __('data.table.name') }}</div>
        <div class="table-cell px-4 py-2 font-bold">{{ __('data.table.email') }}</div>
        <div class="table-cell px-4 py-2 font-bold">{{ __('data.table.phone') }}</div>
        <div class="table-cell px-4 py-2 font-bold">{{ __('data.table.role') }}</div>
        <div class="table-cell px-4 py-2 font-bold rounded-tr-lg">Actions</div>
      </div>
      <div class="table-row-group">
        <!-- User details -->
        @foreach ($users as $user)
          <div
            class="table-row border-b border-gray-200 bg-white text-slate-600 dark:bg-gray-600 dark:text-gray-200 md:border-none hover:text-sky-400">
            <a href="{{ route('profile.index', $user->id) }}"
              class="h-16 border-b-2 px-4 py-2 font-medium md:table-cell block">
              <i class="fi fi-rr-user {{ $user->active_status == 1 ? 'text-green-500' : 'text-red-500' }}"></i>
              {{ $user->name }}
            </a>
            <div class="h-16 border-b-2 px-4 py-2 md:table-cell">
              {{ $user->email }}
            </div>
            {{-- @if ($user->phone_number != null) --}}
              <div class="h-16 border-b-2 px-4 py-2 md:table-cell">
                {{ $user->phone_number }}
              </div>
            {{-- @endif --}}
            <div class="h-16 border-b-2 px-4 py-2 md:table-cell">
              @if ($user->is_admin == 1)
                <span class="rounded-lg bg-sky-100 px-2 py-1 font-medium text-sky-800">Admin</span>
              @else
                <span class="rounded-lg bg-sky-100 px-2 py-1 font-medium text-sky-800">{{ __('content.member') }}</span>
              @endif
            </div>
            <div class="mb-20 flex h-16 items-center border-b-2 px-4 md:table-cell md:py-2">
              <button {{ $user == Auth::user() ? 'disabled' : '' }} type="button"
                class="{{ $user == Auth::user() ? 'text-gray-300 dark:text-gray-400' : 'hover:text-red-500' }}"
                title="Delete This User" wire:click="deleteUser({{ $user->id }})">
                <i class="fi fi-rr-trash"></i>
              </button>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <!-- Pagination -->
    <div class="mt-6 w-full dark:!text-gray-200">
      {{ $users->links() }}
    </div>
  </div>
</div>

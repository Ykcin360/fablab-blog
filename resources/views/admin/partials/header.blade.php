<header
  class=" container mx-auto px-2 flex h-16 md:w-full items-center bg-white text-gray-700 shadow-lg dark:bg-gray-700 rounded-2xl mt-2">
  <div class="flex-center relative mx-auto flex h-full flex-col justify-center px-3">
    <div class="lg:max-w-68 relative flex w-full items-center pl-1 text-lg dark:text-gray-300 sm:ml-0 sm:pr-2">
      @if (request()->routeIs('admin.dashboard'))
      {{ __('content.chart&user') }}
      @elseif (request()->routeIs('admin.category'))
      {{ __('content.category-manager') }}
      @elseif (request()->routeIs('admin.gender'))
      {{ __('content.gender-manager') }}
      @elseif (request()->routeIs('admin.posts'))
      {{ __('content.post-manager') }}
      @elseif (request()->routeIs('admin.reciclebin'))
      {{ __('content.reciclebin') }}
      @endif
    </div>
  </div>
</header>
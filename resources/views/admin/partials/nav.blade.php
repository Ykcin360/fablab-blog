<div class="hidden items-center justify-center pt-6 text-xl text-gray-600 dark:text-gray-200 md:flex">
  {{ __('content.admin-welcome') }} {{ Auth::user()->last_name }}
</div>
<nav class="mt-6">
  <div class=" min-w-screen container mx-auto flex justify-around md:flex-col">
    <!-- Dashboard -->
    <a class="{{ request()->routeIs('admin.dashboard') ? 'text-sky-500 transition-colors duration-200 md:border-r-4 border-sky-500 md:bg-gradient-to-r from-white to-blue-100' : 'text-gray-500' }} my-2 flex items-center justify-start p-4 font-thin uppercase hover:text-sky-500 dark:from-gray-700 dark:to-gray-800 dark:text-gray-200 dark:hover:text-sky-500 md:w-full"
      href="{{ route('admin.dashboard') }}">
      <i class="fi fi-rr-chart-histogram {{ request()->routeIs('admin.dashboard') ? 'text-sky-500':'' }}"></i>
      <span class="md:mx-4 hidden text-xs font-normal md:block">
        {{ __('content.dashboard-menu') }}
      </span>
    </a>

    <!-- Categories -->
    <a class="{{ request()->routeIs('admin.category') ? 'text-sky-500 transition-colors duration-200 md:border-r-4 border-sky-500 md:bg-gradient-to-r from-white to-blue-100' : 'text-gray-500' }} my-2 flex items-center justify-start p-4 font-thin uppercase hover:text-sky-500 dark:from-gray-700 dark:to-gray-800 dark:text-gray-200 dark:hover:text-sky-500 md:w-full"
      href="{{ route('admin.category') }}">
      <i class="fi fi-rr-apps {{ request()->routeIs('admin.category') ? 'text-sky-500':'' }}"></i>
      <span class="md:mx-4 hidden text-xs font-normal md:block">
        {{ __('content.categories-menu') }}
      </span>
    </a>

    <!-- Genders -->
    <a class="{{ request()->routeIs('admin.gender') ? 'text-sky-500 transition-colors duration-200 md:border-r-4 border-sky-500 md:bg-gradient-to-r from-white to-blue-100' : 'text-gray-500' }} my-2 flex items-center justify-start p-4 font-thin uppercase hover:text-sky-500 dark:from-gray-700 dark:to-gray-800 dark:text-gray-200 dark:hover:text-sky-500 md:w-full"
      href="{{ route('admin.gender') }}">
      <i class="fi fi-rr-venus-mars {{ request()->routeIs('admin.gender') ? 'text-sky-500':'' }}"></i>
      <span class="md:mx-4 hidden text-xs font-normal md:block">
        {{ __('content.genders-menu') }}
      </span>
    </a>

    <!-- Posts -->
    <a class="{{ request()->routeIs('admin.posts') ? 'text-sky-500 uppercase transition-colors duration-200 md:border-r-4 border-sky-500 md:bg-gradient-to-r from-white to-blue-100' : 'text-gray-500' }} my-2 flex items-center justify-start p-4 font-thin uppercase transition-colors duration-200 hover:text-sky-500 dark:from-gray-700 dark:to-gray-800 dark:text-gray-200 dark:hover:text-sky-500 md:w-full"
      href="{{ route('admin.posts') }}">
      <i class="fi fi-rr-browser {{ request()->routeIs('admin.posts') ? 'text-sky-500':'' }}"></i>
      <span class="md:mx-4 hidden text-xs font-normal md:block">
        {{ __('content.posts-menu') }}
      </span>
    </a>

    <!-- Recicle Bin -->
    <a class="{{ request()->routeIs('admin.reciclebin') ? 'text-sky-500 uppercase transition-colors duration-200 md:border-r-4 border-sky-500 md:bg-gradient-to-r from-white to-blue-100' : 'text-gray-500' }} my-2 flex items-center justify-start p-4 font-thin uppercase transition-colors duration-200 hover:text-sky-500 dark:from-gray-700 dark:to-gray-800 dark:text-gray-200 dark:hover:text-sky-500 md:w-full"
      href="{{ route('admin.reciclebin') }}">
      <i class="fi fi-rr-trash {{ request()->routeIs('admin.reciclebin') ? 'text-sky-500':'' }}"></i>
      <span class="md:mx-4 hidden text-xs font-normal md:block">
        {{ __('content.reciclebin-menu') }}
      </span>
    </a>

    <!-- Exit -->
    <a class="my-2 flex items-center justify-start p-4 font-thin uppercase text-gray-500 transition-colors duration-200 hover:text-red-500 dark:text-gray-200 md:w-full"
      href="{{ route('post.index') }}">
      <i class="fi fi-rr-exit"></i>
      <span class="md:mx-4 hidden text-xs font-normal md:block">
        {{ __('content.exit-menu') }}
      </span>
    </a>
  </div>
</nav>

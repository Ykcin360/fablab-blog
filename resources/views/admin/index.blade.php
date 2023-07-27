<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('navigation.dahboard') }}
    </h2>
  </x-slot>

  <main class="relative m-6 max-w-screen md:overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800">
    <div class="h-auto grid-flow-col items-start justify-between md:flex">
      <!-- Dashboard Navigation -->
      <div class=" md:h-screen my-6 px-2 md:ml-4 w-full rounded-2xl bg-white drop-shadow-md dark:bg-gray-700  md:w-[35%]">
        @include('admin.partials.nav')
      </div>

      <div class=" md:h-screen w-full flex-col pl-0 md:space-y-4 md:p-4">
        <!-- Dashboard Header -->
        @include('admin.partials.header')

        <!-- Dashboard Content -->
        <div class=" container h-full overflow-auto mx-auto mt-6 md:pt-0 md:pr-0 md:pl-0">
          @yield('content')
        </div>
      </div>
    </div>
  </main>

</x-app-layout>

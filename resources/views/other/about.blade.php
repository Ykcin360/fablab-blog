<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('footer.about') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-12">
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("Fablab Solidaire Mamiratra") }}
        </h1>
        <img src="{{ asset('img/FSM.png') }}" alt="SOSCV" class="object-contain mb-6">
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __('content.about-content') }}
        </p>
      </div>

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-12">
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("SOS Villages d'Enfants") }}
        </h1>
        <div class="">
          <img src="{{ asset('img/SOSVE.png') }}" alt="SOSCV" class="object-contain mb-6">
          <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
            {{ __('content.about-page.sosve') }}
          </p>
        </div>
        <a type="button" data-te-ripple-init data-te-ripple-color="light"
          href="https://vesosmad.org/" target="_blank"
          class="w-full bg-sky-600 text-white font-bold text-sm normal-case rounded hover:bg-sky-700 flex items-center justify-center px-2 py-3 mt-6">
          <p>{{ __('content.about-page.visit') }} SOS
          Villages d'enfants Website</p>
        </a>
      </div>

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("Orange Madagascar") }}
        </h1>
        <div class="">
          <img src="{{ asset('img/FO.jpg') }}" alt="FO" class="object-contain w-full mb-6">
          <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
            {{ __("content.about-page.orange") }}
          </p>
        </div>
        <a type="button" data-te-ripple-init data-te-ripple-color="light"
          href="https://www.orange.mg/" target="_blank"
          class="w-full bg-sky-600 text-white font-bold text-sm normal-case rounded hover:bg-sky-700 flex items-center justify-center px-2 py-3 mt-6">
          <p>{{ __('content.about-page.visit') }} Orange Madagascar Website</p>
        </a>
      </div>
    </div>
  </div>

  @include('post.partials.footer')
</x-app-layout>
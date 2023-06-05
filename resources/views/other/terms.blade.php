<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('footer.terms-conditions') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-12">
        <p class="px-8 py-6 text-gray-700 dark:text-gray-400">
          {{ __('content.terms.heading') }}</p>
      </div>

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.terms.use") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.terms.use-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.terms.messaging") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.terms.messaging-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.terms.privacy") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.terms.privacy-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.terms.property") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.terms.property-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.terms.disclaimers") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.terms.disclaimers-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.terms.limitation") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.terms.limitation-content") }}</p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.terms.law") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.terms.law-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.terms.contact") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.terms.contact-content") }} <a href="{{ route('contact') }}" class="text-sky-600">Fablab Blog Contact</a>
        </p>
      </div>
    </div>
  </div>

  @include('post.partials.footer')
</x-app-layout>
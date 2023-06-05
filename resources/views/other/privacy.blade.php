<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('footer.privacy') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <p class="px-8 py-6 text-gray-700 dark:text-gray-400">
          {{ __("content.privacy.privacy-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.privacy.info-collect") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.privacy.collect-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.privacy.info-use") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.privacy.use-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.privacy.info-share") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.privacy.share-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.privacy.security") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.privacy.security-content") }}
        </p>
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("content.privacy.rights") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __("content.privacy.rights-content") }} <a class="underline">fablab.blog.sm@gmail.com</a>
        </p>
      </div>
    </div>
  </div>

  @include('post.partials.footer')
</x-app-layout>
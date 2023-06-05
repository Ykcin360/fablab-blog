<?php $emailSent = true;?>
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('footer.contact') }}
    </h2>
  </x-slot>

  <div class="py-12">

    @if (session('emailSent'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
      @if ($emailSent == true)
      <div class="bg-green-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <p class="text-green-500 p-4 tracking-wider text-center">{{ __('Votre Email a bien été envoyé.') }} ✅</p>
      </div>
      @elseif ($emailSent == false)
      <div class="bg-red-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <p class="text-red-500 p-4 tracking-wider text-center">{{ __('Il y a eu un petit problème lors de l\'envoi de
          votre
          email.') }} ⛔</p>
      </div>
      @endif
    </div>
    @endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("Fablab Solidaire Mamiratra") }}
        </h1>
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __('content.contact.intro') }}
        </p>
        <hr class="mx-6">
        <form method="POST" action="{{ route('send-email') }}" class="p-6">
          @csrf

          <!-- Title Address -->
          <div class="mb-2">
            <x-input-label for="title" :value="__('content.contact.title')" />
            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus
              autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
          </div>

          <!-- Subject Address -->
          <div class="mb-2">
            <x-input-label for="subject" :value="__('content.contact.subject')" />
            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" required autofocus
              autocomplete="subject" />
            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
          </div>

          <!-- Body Address -->
          <div>
            <x-input-label for="body" :value="__('content.contact.body')" />
            <x-textarea rows=5 id="body" class="block mt-1 w-full" name="body" :content="old('body')" required
              autofocus />
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
          </div>

          <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
              {{ __('content.contact.send') }}
            </x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @include('post.partials.footer')
</x-app-layout>
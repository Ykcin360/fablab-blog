<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
      {{ __('navigation.edit-post') }} {{ $post->title }}
    </h2>
  </x-slot>

  <div class="flex flex-col items-center bg-gray-100 py-6 dark:bg-gray-900 sm:justify-center sm:pt-0">

    <!-- Errors -->
    @foreach ($errors as $error)
      <span class="my-6 space-y-1 text-sm text-red-600 dark:text-red-400">{{ $error }}</span>
    @endforeach

    <div class="mt-6 h-auto overflow-hidden bg-white px-6 py-4 shadow-md dark:bg-gray-800 sm:rounded-lg md:w-1/2">
      <form method="post" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex w-full justify-end">
          <a href="{{ URL::previous() }}"
            class="rounded-full px-2 text-gray-500 transition-colors duration-200 hover:text-gray-600 dark:hover:text-gray-200">
            <i class="fi fi-rr-home"></i>
          </a>
        </div>

        <!-- Post Title -->
        <div>
          <x-input-label for="title" :value="__('content.post-title')" />
          <x-text-input id="title" class="mt-1 block w-full" type="text" name="title"
            value="{{ $post->title }}" required autofocus />
          <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Post Content -->
        <div class="mt-4">
          <x-input-label for="content" :value="__('content.post-body')" />
          <x-textarea id="content" class="mt-1 block w-full" name="content" :value="old('content')" :content="$post->content"
            required autofocus />
          <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <!-- Post Image -->
        <div class="mt-4">
          <x-input-label for="image" :value="__('content.post-image')" />
          <x-file-input id="image" class="mt-1 block w-full" name="image" accept="image/*" :value="old('image')"
            style="padding: 1em" />
        </div>

        <!-- Post Category -->
        <div class="mt-4">
          <x-input-label :value="__('content.post-category')" />
          <select id="category"
            class='mt-1 w-full rounded-md border-gray-300 py-4 px-4 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600'
            name="category" required>
            <option value="" disabled selected>Select Category</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
          <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-end">
          <x-primary-button class="ml-3">
            {{ __('content.update') }}
          </x-primary-button>
        </div>
      </form>
    </div>

  </div>
</x-app-layout>

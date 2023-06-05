<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('navigation.new-post') }}
        </h2>
    </x-slot>
    
    <div class="flex flex-col lg:flex-row-reverse lg:items-start sm:justify-around items-center md:my-6 py-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

        <div class=" w-[70%] md:w-80 h-96 mt-6 px-6 py-4 bg-white dark:text-gray-200 dark:bg-gray-800 shadow-md overflow-auto rounded-lg">
            <span class="block text-gray-800 font-bold w-full dark:text-gray-200">{{ __('content.tips-rules') }}</span>
            <ul class="list-disc mt-2 px-2 text-gray-700 dark:text-gray-500 w-full space-y-4">
                <li>{{ __('content.tr1') }}</li>
                <li>{{ __('content.tr2') }}</li>
                <li>{{ __('content.tr3') }}</li>
                <li>{{ __('content.tr4') }}</li>
                <li>{{ __('content.tr5') }}</li>
                <li>{{ __('content.tr6') }}</li>
            </ul>
        </div>

        <div class="md:w-1/2 mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">
            <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
        
                <!-- Post Title -->
                <div>
                    <x-input-label for="title" :value="__('content.post-title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Post Content -->
                <div class="mt-4">
                    <x-input-label for="content" :value="__('content.post-body')" />
                    <x-textarea rows=5 id="content" class="block mt-1 w-full" name="content" :content="old('content')" required autofocus/>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <!-- Post Image -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('content.post-image')" />
                    <x-file-input id="image" class="block mt-1 w-full" name="image" accept="image/*" :value="old('image')" style="padding: 1em" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- Post Category -->
                <div class="mt-4">
                    <x-input-label :value="__('content.post-category')" />
                    <select id="category" class='border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full mt-1 py-4 px-4' name="category" required>
                        <option value="" disabled selected>{{ __('content.select-category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>
        
                <div class="flex items-center justify-end mt-4">      
                    <x-primary-button class="ml-3">
                        {{ __('content.create') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

    </div>

    @include('post.partials.footer')
    
</x-app-layout>    
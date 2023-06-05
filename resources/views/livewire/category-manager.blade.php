<div>
  <!-- New Category -->
  @if ($editingCategoryId != null)
    <form wire:submit.prevent="updateCategory">
      @csrf
      <div>
        <x-input-label for="newCategoryName" :value="__('content.edit-category')" />
        <x-text-input id="newCategoryName" class="mt-4 block w-full" type="text" wire:model.defer="newCategoryName"
          :value="old('newCategoryName')" required autofocus />
      </div>
      <div class="mt-4 flex items-center justify-between">
        <x-primary-button>
          {{ __('content.save') }}
        </x-primary-button>
        <button
          class="rounded-md border py-2 px-3 text-xs font-bold uppercase text-gray-700 hover:bg-sky-500 hover:text-gray-200 dark:text-gray-200"
          wire:click="cancelEdit()">{{ __('content.cancel') }}</button>
      </div>
    </form>
  @else
    <form wire:submit.prevent="addCategory">
      @csrf
      <div>
        <x-input-label for="name" :value="__('content.new-category')" />
        <x-text-input id="name" class="mt-4 block w-full" type="text" wire:model="name" :value="old('title')"
          required autofocus />
      </div>
      <div class="mt-4 flex items-center justify-start">
        <x-primary-button wire:click="addCategory">
          {{ __('content.add') }}
        </x-primary-button>
      </div>
    </form>
  @endif

  <hr class="my-6">

  @if (session()->has('error'))
    <div class="relative mb-6 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700" role="alert">
      <strong class="font-bold">Error!</strong>
      <span class="block sm:inline">{{ session('error') }}</span>
    </div>
  @endif


  <div class="relative overflow-hidden rounded-xl bg-gray-200 dark:bg-gray-800">
    {{-- <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,#fff,rgba(255,255,255,0.6))] dark:bg-grid-slate-700/25 dark:[mask-image:linear-gradient(0deg,rgba(255,255,255,0.1),rgba(255,255,255,0.5))]"></div> --}}
    <div class="relative overflow-auto rounded-xl">
      <div class="mt-2 overflow-hidden shadow-sm">
        <table class="w-full table-fixed border-collapse text-sm">
          <thead>
            <tr>
              <th
                class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                Category</th>
              <th
                class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                Action</th>
            </tr>
          </thead>
          <tbody class="bg-gray-100 text-slate-500 dark:bg-gray-600 dark:text-gray-200">
            @foreach ($categories as $category)
              <tr>
                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700 capitalize">
                  {{ $category->name }}</td>
                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700">
                  <button class="text-sky-800 dark:text-sky-300"
                    wire:click="editCategory({{ $category->id }})">{{ __('content.edit') }}</button>
                  <button class="ml-6 text-red-600 dark:text-red-400"
                    wire:click="deleteCategory({{ $category->id }})">{{ __('content.delete') }}</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{-- <div class="absolute inset-0 pointer-events-none border border-black/5 rounded-xl dark:border-white/5"></div> --}}
  </div>
</div>

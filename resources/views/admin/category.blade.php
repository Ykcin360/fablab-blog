@extends('admin.index')

@section('content')
  <div class="flex flex-col flex-wrap sm:flex-row">
    <div class="w-full">
      <div class="mb-4">
        <div class="h-full w-full rounded-2xl bg-white p-4 shadow-lg dark:bg-gray-700">
          @livewire('category-manager')
        </div>
      </div>
    </div>
  </div>
@endsection
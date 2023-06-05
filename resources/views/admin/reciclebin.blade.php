@extends('admin.index')

@section('content')
<div class="flex flex-col flex-wrap sm:flex-row">
  <div class="w-full">
    <div class="mb-4">
      @livewire('recicle-bin')
    </div>
  </div>
</div>
@endsection
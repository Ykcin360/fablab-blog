@extends('admin.index')

@section('content')
  <div class="flex flex-col flex-wrap sm:flex-row">
    <div class="w-full">
      <div class="mb-4">
        <div class="h-full w-full rounded-2xl bg-white p-4 shadow-lg dark:bg-gray-700">
          <!-- Dashboard Graph here:-->
          <div class="!dark:text-gray-200 mb-6 flex items-center justify-around">
            <canvas id="users-chart"></canvas>
            <canvas id="chats-chart"></canvas>
            <canvas id="posts-chart"></canvas>
            <style>
              #users-chart,
              #chats-chart,
              #posts-chart {
                width: 150px !important;
                height: 150px !important;
              }
            </style>
          </div>
          <!-- Dashboard Table here:-->
          @livewire('users-table')
        </div>
      </div>
    </div>
  </div>
  
  <script src="{{ asset('js/chart.js') }}" defer></script>
@endsection
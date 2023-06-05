<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Fablab') }}</title>

  @livewireStyles

  <link rel="icon" href="{{ asset("img/fablab.png") }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('css/darkmode-toogle.css') }}">
  <!-- Uicons -->
  <link rel='stylesheet' href='{{ asset('css/uicons/css/uicons-regular-rounded.css') }}'>
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireScripts
</head>

<body class="font-sans antialiased dark:bg-gray-900 text-gray-800 dark:text-gray-200">
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
      <header class="bg-white shadow dark:bg-gray-800">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>
    @endif

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div>

  <!-- Scripts -->
  {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
  <script src="{{ asset('js/tailwindcss.js') }}" defer></script>
  <script src="{{ asset('js/darkmode-toogle.js') }}" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/f3f0d36f61.js" crossorigin="anonymous" defer></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" defer></script>

</body>

</html>

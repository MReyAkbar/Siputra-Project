<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'SIPUTRA Admin')</title>
  <meta name="description" content="Admin panel">

  <!-- Favicon & touch icons -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}">
  <link rel="shortcut icon" href="{{ asset('favicon-32x32.png') }}">

  <!-- Fonts & icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/c751376482.js" crossorigin="anonymous"></script>

  <!-- Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <script src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8/dist/turbo.es2017-esm.js"></script>
</head>
<body class="min-h-screen flex bg-gray-100 text-gray-800">

  <x-admin-aside />

  <div class="flex-1 flex flex-col">
    <x-admin-header />

    <main class="p-6 pl-[285px]">
      <div class="max-w-7xl mx-auto">
        @if (session('status'))
          <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        @yield('content')
      </div>
    </main>
  </div>

  @stack('scripts')

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'SIPUTRA Admin')</title>
  <meta name="description" content="Admin panel">

  <!-- Fonts & icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/c751376482.js" crossorigin="anonymous"></script>

  <!-- Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex bg-gray-100 text-gray-800">

  {{-- Sidebar (fixed) --}}
  <x-admin-aside />

  {{-- Main content (with left padding to accommodate fixed sidebar) --}}
  <div class="flex-1 min-h-screen">
    <header class="bg-white border-b">
      <div class="max-w-7xl mx-auto p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <img src="{{ asset('images/siputra-logo.png') }}" alt="logo" class="w-10 h-auto rounded" />
          <div>
            <h1 class="text-lg font-semibold">SIPUTRA Admin</h1>
            <p class="text-xs text-gray-500">Dashboard</p>
          </div>
        </div>
        <div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-3 py-1 border rounded">Logout</button>
          </form>
        </div>
      </div>
    </header>

    <main class="p-6" style="padding-left:16rem;"> {{-- 16rem = 64 (w-64) --}}
      <div class="max-w-7xl mx-auto">
        @if (session('status'))
          <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        @yield('content')
      </div>
    </main>
  </div>

  @stack('scripts')
</body>
</html>

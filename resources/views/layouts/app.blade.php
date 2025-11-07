<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>@yield('title', 'SIPUTRA')</title>
		<meta name="description" content="@yield('meta_description', 'sistem informasi produk & profil pt putra samudera nusantara')">

		<!-- Favicon & touch icons -->
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
		<link rel="manifest" href="{{ asset('site.webmanifest') }}">
		<link rel="shortcut icon" href="{{ asset('favicon-32x32.png') }}">

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

		<link rel="preconnect" href="https://fonts.bunny.net">
		<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

		<script src="https://kit.fontawesome.com/c751376482.js" crossorigin="anonymous"></script>

		<!-- Scripts -->
		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body class="font-sans antialiased bg-gray-100 text-gray-900 flex flex-col min-h-screen">
		<x-header	/>

		@if (session('status'))
			<div class="max-w-7xl mx-auto w-full px-4 mt-6">
				<div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
					{{ session('status') }}
				</div>
			</div>
		@endif

		<main class="flex-1">
			@yield('content')
		</main>

		<x-footer	/>
	</body>
</html>

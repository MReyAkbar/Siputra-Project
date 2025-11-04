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
    <style>
        body {
            background: linear-gradient(135deg, #0f1b3a 0%, #1e3a8a 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="h-full flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        @yield('content')
    </div>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function () {
	document.querySelectorAll('.toggle-password').forEach(button => {
		button.addEventListener('click', function () {
			const input = this.previousElementSibling;
			const icon = this.querySelector('svg');
			
			if (input.type === 'password') {
				input.type = 'text';
				icon.innerHTML = `
					<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
				`;
			} else {
				input.type = 'password';
				icon.innerHTML = `
					<path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.23 2.76-2.82 3.44-4.75C21.27 7.61 17 4.5 12 4.5c-1.54 0-3.03.25-4.41.67l2.04 2.04C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.25 4.41-.67l.46.46L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.77l1.54 1.54C9.04 11.47 9 11.73 9 12c0 1.66 1.34 3 3 3 .27 0 .53-.04.77-.1l1.54 1.54c-.47.16-.97.26-1.5.26-2.76 0-5-2.24-5-5 0-.53.1-1.03.26-1.5z"/>
				`;
			}
		});
	});
});
</script>
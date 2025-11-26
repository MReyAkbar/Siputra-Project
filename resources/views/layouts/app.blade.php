<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>@yield('title', 'SIPUTRA')</title>
		<meta name="description" content="@yield('meta_description', 'sistem informasi produk & profil pt putra samudera nusantara')">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Favicon & touch icons -->
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
		<link rel="manifest" href="{{ asset('site.webmanifest') }}">
		<link rel="shortcut icon" href="{{ asset('favicon-32x32.png') }}">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

	<a href="{{ route('chatbot') }}" 
		class="
				fixed bottom-6 right-6 z-50  
				flex h-16 w-16 items-center justify-center 
				rounded-full 
				bg-blue-600 text-white 
				shadow-lg 
				transition-colors hover:bg-blue-700
		">
			
			<i class="bi bi-chat-dots-fill text-2xl"></i>
			
    </a>
		<x-footer	/>

		<div id="toastContainer" class="fixed top-20 right-6 z-50 space-y-3 pointer-events-none">
		</div>

		<script>
		function showToast(type, message, duration = 4000) {
				const container = document.getElementById('toastContainer');
				if (!container) return;

				const toast = document.createElement('div');
				toast.className = `pointer-events-auto transform transition-all duration-300 ease-in-out translate-x-full opacity-0`;
				
				const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
				const icon = type === 'success' 
					? '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>'
					: '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>';
				
				toast.innerHTML = `
					<div class="${bgColor} text-white px-6 py-4 rounded-xl shadow-2xl flex items-start gap-3 max-w-md">
						<svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
							${icon}
						</svg>
						<div class="flex-1">
							<p class="font-semibold text-sm leading-relaxed">${message}</p>
						</div>
						<button onclick="this.closest('div').parentElement.remove()" class="flex-shrink-0 ml-2 text-white hover:text-gray-200 transition-colors">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
							</svg>
						</button>
					</div>
				`;
				
				container.appendChild(toast);
				
				setTimeout(() => {
					toast.classList.remove('translate-x-full', 'opacity-0');
					toast.classList.add('translate-x-0', 'opacity-100');
				}, 10);
				
				setTimeout(() => {
					toast.classList.add('translate-x-full', 'opacity-0');
					setTimeout(() => toast.remove(), 300);
				}, duration);
		}

		// Make function globally available
		window.showToast = showToast;
		</script>

		<!-- Session Flash Messages (for page reloads) -->
		@if(session('success'))
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				showToast('success', "{{ session('success') }}");
			});
		</script>
		@endif

		@if(session('error'))
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				showToast('error', "{{ session('error') }}");
			});
		</script>
		@endif

		@if($errors->any())
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				showToast('error', "{{ $errors->first() }}");
			});
		</script>
		@endif
	</body>
</html>

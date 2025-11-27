<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'SIPUTRA')</title>
        <meta name="description" content="@yield('meta_description', 'sistem informasi produk & profil pt putra samudera nusantara')">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="shortcut icon" href="{{ asset('favicon-32x32.png') }}">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://kit.fontawesome.com/c751376482.js" crossorigin="anonymous"></script>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Animasi Ripple/Gelombang */
            @keyframes ripple-wave {
                0% { transform: scale(1); opacity: 0.6; }
                100% { transform: scale(1.6); opacity: 0; }
            }
            .group:hover .group-hover\:animate-ripple {
                animation: ripple-wave 1.2s infinite ease-out;
            }

            /* Animasi Bounce Lambat */
            @keyframes bounce-slow {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            .animate-bounce-hover:hover {
                animation: bounce-slow 0.6s ease-in-out;
            }
        </style>
    </head>

    <body class="font-sans antialiased bg-gray-100 text-gray-900 flex flex-col min-h-screen">
        <x-header />

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

        <div id="chatbotBubble" class="fixed bottom-48 right-6 mb-4 z-50 opacity-0 transform translate-y-2 transition-all duration-300 pointer-events-none">
            <div class="bg-white rounded-2xl shadow-2xl p-4 max-w-xs relative">
                <div class="absolute -bottom-2 right-6 w-4 h-4 bg-white transform rotate-45"></div>
                <div class="relative z-10">
                    <p class="text-gray-800 font-medium text-sm">
                        Ada Pertanyaan? Tanyakan <span class="text-blue-600 font-bold">Saya!</span>
                    </p>
                    <p class="text-gray-500 text-xs mt-1">AI Assistant 24/7</p>
                </div>
            </div>
        </div>

        <div class="fixed bottom-28 right-6 z-50">
            <a href="{{ route('chatbot') }}" 
            id="chatbotBtn"
            class="group animate-bounce-hover relative flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-[#0E3E6D] to-[#0F4175] text-white shadow-2xl transition-all duration-300 hover:scale-105 active:scale-95">
                
                <div class="absolute inset-0 rounded-full border-2 border-blue-300 opacity-0 group-hover:animate-ripple"></div>
                
                <div class="relative z-10 w-full h-full rounded-full overflow-hidden border-2 border-[#0F4175] shadow-lg bg-white">
                    <img src="{{ asset('images/chatbot-button.png') }}" 
                        alt="AI" 
                        class="w-full h-full object-cover"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    
                    <div class="hidden w-full h-full bg-gradient-to-br from-blue-600 to-blue-700 items-center justify-center">
                        <i class="bi bi-robot text-3xl text-white"></i>
                    </div>
                </div>
            </a>
        </div>

        <div id="waBubble" class="fixed bottom-24 right-6 mb-2 z-50 opacity-0 transform translate-y-2 transition-all duration-300 pointer-events-none">
            <div class="bg-white rounded-2xl shadow-2xl p-3 px-4 max-w-xs relative">
                <div class="absolute -bottom-2 right-6 w-4 h-4 bg-white transform rotate-45"></div>
                <div class="relative z-10">
                    <p class="text-gray-800 font-medium text-sm whitespace-nowrap">
                        Chat via <span class="text-green-600 font-bold">WhatsApp</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="fixed bottom-6 right-6 z-40">
            <a href="https://api.whatsapp.com/send/?phone=6282141451578&text=Halo%2C+saya+ingin+bertanya+tentang+layanan+SIPUTRA&type=phone_number&app_absent=0" 
            id="waBtn"
            target="_blank"
            class="group animate-bounce-hover relative flex h-16 w-16 items-center justify-center rounded-full bg-green-500 text-white shadow-2xl transition-all duration-300 hover:scale-105 active:scale-95">
                
                <div class="absolute inset-0 rounded-full border-2 border-green-300 opacity-0 group-hover:animate-ripple"></div>
                
                <i class="bi bi-whatsapp text-3xl relative z-10"></i>
            </a>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Helper function to handle hover effects
            function setupBubble(btnId, bubbleId) {
                const btn = document.getElementById(btnId);
                const bubble = document.getElementById(bubbleId);

                if (btn && bubble) {
                    btn.addEventListener('mouseenter', () => {
                        bubble.classList.remove('opacity-0', 'translate-y-2', 'pointer-events-none');
                        bubble.classList.add('opacity-100', 'translate-y-0');
                    });

                    btn.addEventListener('mouseleave', () => {
                        setTimeout(() => {
                            bubble.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                            bubble.classList.remove('opacity-100', 'translate-y-0');
                        }, 300);
                    });
                }
            }

            // Setup Chatbot Bubble
            setupBubble('chatbotBtn', 'chatbotBubble');
            
            // Setup WA Bubble
            setupBubble('waBtn', 'waBubble');

            // Auto-show Chatbot bubble once on load
            const chatBubble = document.getElementById('chatbotBubble');
            if (chatBubble && !sessionStorage.getItem('chatBubbleShown')) {
                setTimeout(() => {
                    chatBubble.classList.remove('opacity-0', 'translate-y-2', 'pointer-events-none');
                    chatBubble.classList.add('opacity-100', 'translate-y-0');
                    
                    setTimeout(() => {
                        chatBubble.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                        chatBubble.classList.remove('opacity-100', 'translate-y-0');
                    }, 5000);
                    
                    sessionStorage.setItem('chatBubbleShown', 'true');
                }, 3000);
            }
        });

        // Toast Notification Logic
        function showToast(type, message, duration = 4000) {
            const container = document.getElementById('toastContainer');
            if (!container) return;
            const toast = document.createElement('div');
            toast.className = `pointer-events-auto transform transition-all duration-300 ease-in-out translate-x-full opacity-0`;
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            const icon = type === 'success' 
                ? '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>'
                : '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>';
            
            toast.innerHTML = `
                <div class="${bgColor} text-white px-6 py-4 rounded-xl shadow-2xl flex items-start gap-3 max-w-md">
                    <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">${icon}</svg>
                    <div class="flex-1"><p class="font-semibold text-sm leading-relaxed">${message}</p></div>
                    <button onclick="this.closest('div').parentElement.remove()" class="ml-2 text-white hover:text-gray-200"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                </div>`;
            container.appendChild(toast);
            setTimeout(() => { toast.classList.remove('translate-x-full', 'opacity-0'); toast.classList.add('translate-x-0', 'opacity-100'); }, 10);
            setTimeout(() => { toast.classList.add('translate-x-full', 'opacity-0'); setTimeout(() => toast.remove(), 300); }, duration);
        }
        window.showToast = showToast;
        </script>

        <x-footer />
        <div id="toastContainer" class="fixed top-20 right-6 z-50 space-y-3 pointer-events-none"></div>

        @if(session('success')) <script>document.addEventListener('DOMContentLoaded', () => showToast('success', "{{ session('success') }}"));</script> @endif
        @if(session('error')) <script>document.addEventListener('DOMContentLoaded', () => showToast('error', "{{ session('error') }}"));</script> @endif
        @if($errors->any()) <script>document.addEventListener('DOMContentLoaded', () => showToast('error', "{{ $errors->first() }}"));</script> @endif
    </body>
</html>
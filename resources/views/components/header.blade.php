<header class="bg-[#134686] text-white sticky top-0 z-50" x-data="{ mobileOpen: false }">
  <div class="max-w-7xl mx-auto flex items-center justify-between p-4">

    <a href="{{ url('/') }}" class="flex items-center gap-3 group:">
      <img src="{{ asset("images/siputra-logo.png") }}" class="w-12 h-auto rounded-full ring-2 ring-white/20 group-hover:ring-white transition" alt="logo siputra">
      <div class="block">
        <h3 class="text-2xl font-bold tracking-tight">SIPUTRA</h3>
        <p class="text-xs opacity-80">Sistem Informasi Putra Samudra</p>
      </div>
    </a>

    <nav aria-label="Main navigation" class="hidden md:flex items-center space-x-1" x-data="{ open: false }">
      <ul class="flex items-center space-x-1">
        <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'bg-[#0C3C65] text-white' : 'hover:bg-[#0C3C65]' }} px-4 py-2 rounded-lg font-medium transition">Beranda</a></li>

        <li class="relative" @click.away="open = false">
          <button @click="open = !open" class="flex items-center gap-1 {{ request()->is('katalog', 'gudang') ? 'bg-[#0C3C65] text-white' : 'hover:bg-[#0C3C65]' }} px-4 py-2 rounded-lg font-medium transition">
            Katalog
            <svg class="w-4 h-4 transition-transform duration-200":class="{ 'rotate-180': open }"fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
          </button>

          <ul x-show="open"
              x-transition:enter="transition ease-out duration-150"
              x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="opacity-100 scale-100"
              x-transition:leave="transition ease-out duration-100"
              x-transition:leave-start="opacity-100 scale-100"
              x-transition:leave-end="opacity-0 scale-95"
              class="absolute left-0 mt-2 w-56 bg-[#0C3C65] rounded-lg shadow-xl overflow-hidden"
              style="display:none">
              
              <li><a href="{{ url('/katalog') }}" class="block px-4 py-4 text-sm hover:bg-[#134686] transition">Katalog Ikan</a></li>

              <li><a href="{{ url('gudang') }}" class="block px-4 py-4 text-sm hover:bg-[#134686] transition">Katalog Gudang</a></li>
          </ul>
        </li>

        <li><a href="{{ url('/tentang-kami') }}"class="{{ request()->is('tentang-kami') ? 'bg-[#0C3C65] text-white' : 'hover:bg-[#0C3C65]' }} px-4 py-2 rounded-lg font-medium transition">Tentang Kami</a></li>
      </ul>
    </nav>

    <div class="hidden md:flex items-center space-x-1">
      @guest
        <a href="{{ route('register') }}" class="px-5 py-2 rounded-xl font-medium hover:bg-[#0C3C65] transition">Sign Up</a>

        <a href="{{ url('/login') }}" class="px-5 py-2 bg-[#0C3C65] rounded-xl font-medium hover:bg-white hover:text-[#134686] transition">Log In</a>
      @else
        <div class="flex items-center gap-3">
          <span class="text-sm">Hi, {{ auth()->user()->name }}</span>
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-sm font-medium transition">Logout</button>
          </form>
        </div>
      @endguest
    </div>

    <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded-lg hover:bg-[#0C3C65] transition" aria-label="Toggle menu">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
  </div>
  
  <div x-show="mobileOpen" 
       @click.away="mobileOpen = false"
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-2"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 -translate-y-2"
       class="md:hidden bg-[#0C3C65] border-t border-white/10"
       style="display:none">
      
    <ul class="p-4 space-y-2">
      <li><a href="{{ url('/') }}" class="block py-2 px-3 rounded-lg hover:bg-[#134686]">Beranda</a></li>

      <li x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex items-center justify-between py-2 px-3 rounded-lg hover:bg-[#134686]">Katalog
          <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }"fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        
        <ul x-show="open" class="ml-4 mt-1 space-y-1" style="display:none">
          <li><a href="{{ url('/katalog') }}" class="block py-2 px-3 text-sm rounded hover:bg-[#134686]">Katalog Ikan</a></li>
          <li><a href="{{ url('/gudang') }}" class="block py-2 px-3 text-sm rounded hover:bg-[#134686]">Katalog Gudang</a></li>
        </ul>
      </li>

      <li><a href="{{ url('/tentang-kami') }}" class="block py-2 px-3 rounded-lg hover:bg-[#134686]">Tentang Kami</a></li>

      @guest
        <li class="pt-3 border-t border-white/10 space-y-2">
          <a href="{{ route('register') }}" class="block py-2 px-3 rounded-lg bg-[#134686] font-medium hover:bg-[#0C3C65] text-center">Sign Up</a>
          <a href="{{ route('login') }}" class="block py-2 px-3 rounded-lg bg-white text-[#134686] font-medium hover:bg-gray-100 text-center">Log In</a>
          </li>
      @else
        <li class="pt-3 border-t border-white/10">
          <div class="flex items-center justify-between py-2 px-3">
            <span class="text-sm">Hi, {{ auth()->user()->name }}</span>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                  <button type="submit" class="text-xs font-medium text-red-300 hover:text-red-200 underline">Logout</button>
              </form>
          </div>
        </li>
      @endguest
    </ul>
  </div>
</header>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
<header class="bg-gradient-to-r from-[#134686] via-[#0C3C65] to-[#134686] text-white sticky top-0 z-50 shadow-lg" x-data="{ mobileOpen: false }">
  <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

    <a href="{{ url('/') }}" class="flex items-center gap-3 group">
      <div class="relative">
        <div class="rounded-full opacity-0 group-hover:opacity-50 transition-opacity"></div>
        <img src="{{ asset('images/siputra-logo.png') }}" class="w-12 h-12 rounded-full relative z-10 transition-all" alt="logo siputra">
      </div>
      <div class="hidden sm:block">
        <h3 class="text-2xl font-bold tracking-tight leading-tight">SIPUTRA</h3>
        <p class="text-xs opacity-80 text-gray-300">Sistem Informasi Putra Samudra</p>
      </div>
    </a>

    <nav aria-label="Main navigation" class="hidden lg:flex items-center space-x-1" x-data="{ open: false }">
      <ul class="flex items-center space-x-1">
        <li>
          <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'bg-white/20 text-white border-b-2 border-yellow-400' : 'hover:bg-white/10' }} px-5 py-2.5 rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Beranda
          </a>
        </li>

        <li class="relative" @click.away="open = false">
          <button @click="open = !open" class="flex items-center gap-2 {{ request()->is('katalog*', 'gudang*') ? 'bg-white/20 text-white border-b-2 border-yellow-400' : 'hover:bg-white/10' }} px-5 py-2.5 rounded-lg font-medium transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            Katalog
            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <ul x-show="open"
              x-transition:enter="transition ease-out duration-150"
              x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
              x-transition:enter-end="opacity-100 scale-100 translate-y-0"
              x-transition:leave="transition ease-in duration-100"
              x-transition:leave-start="opacity-100 scale-100 translate-y-0"
              x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
              class="absolute left-0 mt-3 w-64 bg-white text-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-200"
              style="display:none">

              <li>
                <a href="{{ url('/katalog') }}" class="flex items-center gap-3 px-5 py-4 hover:bg-[#134686] hover:text-white transition-colors group">
                  <div class="w-10 h-10 bg-[#134686] group-hover:bg-white rounded-lg flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-white group-hover:text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                  </div>
                  <div>
                    <div class="font-semibold">Katalog Ikan</div>
                    <div class="text-xs text-gray-500 group-hover:text-gray-200">Produk laut segar</div>
                  </div>
                </a>
              </li>

              <li class="border-t border-gray-100">
                <a href="{{ url('/gudang') }}" class="flex items-center gap-3 px-5 py-4 hover:bg-[#134686] hover:text-white transition-colors group">
                  <div class="w-10 h-10 bg-[#134686] group-hover:bg-white rounded-lg flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-white group-hover:text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                  </div>
                  <div>
                    <div class="font-semibold">Katalog Gudang</div>
                    <div class="text-xs text-gray-500 group-hover:text-gray-200">Fasilitas penyimpanan</div>
                  </div>
                </a>
              </li>
          </ul>
        </li>

        <li>
          <a href="{{ url('/tentang-kami') }}" class="{{ request()->is('tentang-kami') ? 'bg-white/20 text-white border-b-2 border-yellow-400' : 'hover:bg-white/10' }} px-5 py-2.5 rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Tentang Kami
          </a>
        </li>
      </ul>
    </nav>

    <div class="hidden lg:flex items-center gap-3">
      @guest
        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl font-medium hover:bg-white/10 transition-all">
          Sign Up
        </a>
        <a href="{{ route('login') }}" class="px-5 py-2.5 bg-yellow-400 text-[#134686] rounded-xl font-semibold hover:bg-yellow-300 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
          Log In
        </a>
      @else
        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/20">
          <a href="{{ url('/keranjang') }}" class="relative p-2 hover:bg-white/10 rounded-lg transition-all">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span id="cartBadge" class="absolute -top-1 -right-1 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full transition-opacity" style="display: none;">
                0
            </span>
          </a>
          @if(auth()->user()->isAdmin() || auth()->user()->isManager())
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 p-2 hover:bg-white/10 rounded-lg transition-all">
              <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                <span class="text-[#134686] font-bold text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
              </div>
              <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
            </a>
          @else
            <div class="flex items-center gap-2">
              <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                <span class="text-[#134686] font-bold text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
              </div>
              <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
            </div>
          @endif
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-500/20 hover:bg-red-500 rounded-lg text-sm font-medium transition-all">
              Logout
            </button>
          </form>
        </div>
      @endguest
    </div>

    <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg hover:bg-white/10 transition-all" aria-label="Toggle menu">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="mobileOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'"/>
      </svg>
    </button>
  </div>

  <div x-show="mobileOpen"
       @click.away="mobileOpen = false"
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-4"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 -translate-y-4"
       class="lg:hidden bg-[#0C3C65] border-t border-white/10 shadow-xl"
       style="display:none">

    <ul class="p-4 space-y-2 max-h-[calc(100vh-80px)] overflow-y-auto">
      <li>
        <a href="{{ url('/') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:bg-white/10 transition-all {{ request()->is('/') ? 'bg-white/20' : '' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
          <span class="font-medium">Beranda</span>
        </a>
      </li>

      <li x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex items-center justify-between py-3 px-4 rounded-lg hover:bg-white/10 transition-all {{ request()->is('katalog*', 'gudang*') ? 'bg-white/20' : '' }}">
          <div class="flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <span class="font-medium">Katalog</span>
          </div>
          <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>

        <ul x-show="open" 
            x-transition
            class="ml-8 mt-2 space-y-2" 
            style="display:none">
          <li>
            <a href="{{ url('/katalog') }}" class="flex items-center gap-2 py-2 px-4 text-sm rounded-lg hover:bg-white/10 transition-all">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
              </svg>
              Katalog Ikan
            </a>
          </li>
          <li>
            <a href="{{ url('/gudang') }}" class="flex items-center gap-2 py-2 px-4 text-sm rounded-lg hover:bg-white/10 transition-all">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
              </svg>
              Katalog Gudang
            </a>
          </li>
        </ul>
      </li>

      <li>
        <a href="{{ url('/tentang-kami') }}" class="flex items-center gap-3 py-3 px-4 rounded-lg hover:bg-white/10 transition-all {{ request()->is('tentang-kami') ? 'bg-white/20' : '' }}">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span class="font-medium">Tentang Kami</span>
        </a>
      </li>

      @guest
        <li class="pt-4 mt-4 border-t border-white/10 space-y-2">
          <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-white/10 font-medium hover:bg-white/20 text-center transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Sign Up
          </a>
          <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-yellow-400 text-[#134686] font-semibold hover:bg-yellow-300 text-center transition-all shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Log In
          </a>
        </li>
      @else
        <li class="pt-4 mt-4 border-t border-white/10">
          <div class="bg-white/10 backdrop-blur-sm p-4 rounded-lg">
            <div class="flex items-center gap-3 mb-3">
              <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center">
                <span class="text-[#134686] font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
              </div>
              <div>
                <div class="text-sm font-medium">{{ auth()->user()->name }}</div>
                <div class="text-xs text-gray-300">{{ auth()->user()->email }}</div>
              </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-4 bg-red-500/20 hover:bg-red-500 rounded-lg text-sm font-medium transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
              </button>
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

@auth
<script>
document.addEventListener('DOMContentLoaded', function() {
  updateCartBadge();
});

function updateCartBadge() {
fetch('{{ route("cart.count") }}')
  .then(response => response.json())
  .then(data => {
    const badge = document.getElementById('cartBadge');
    if (badge) {
        badge.textContent = data.count;
      if (data.count > 0) {
        badge.style.display = 'inline-flex';
      } else {
        badge.style.display = 'none';
      }
    }
  })
  .catch(error => console.error('Error updating cart badge:', error));
}

// Make function globally available
window.updateCartBadge = updateCartBadge;
</script>
@endauth
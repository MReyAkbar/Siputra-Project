<header class="bg-[#134686] text-white sticky top-0 z-50">
  <div class="max-w-7xl mx-auto flex items-center justify-between p-4">
    <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
      <img src="{{ asset("images/siputra-logo.png") }}" class="w-12 h-auto rounded-full" alt="logo siputra">
      <div class="flex flex-col">
        <h3 class="text-2xl font-semibold">SIPUTRA</h3>
        <p class="text-sm font-semibold">Sistem Informasi Putra Samudra</p>
      </div>
    </a>
    <nav aria-label="Main navigation">
      <ul class="flex space-x-6">
        <li><a href="{{ url('/') }}" class="font-semibold hover:text-gray-400 hover:font-semibold">Beranda</a></li>
        <li><a href="{{ url('/katalog') }}" class="font-semibold hover:text-gray-400 hover:font-semibold">Katalog</a></li>
        <li><a href="{{ url('/gudang') }}" class="font-semibold hover:text-gray-400 hover:font-semibold">Gudang</a></li>
        <li><a href="{{ url('/tentang-kami') }}" class="font-semibold hover:text-gray-400 hover:font-semibold">Tentang Kami</a></li>
      </ul>
    </nav>

    <div class="flex space-x-4">
      <a href="" class="font-semibold px-5 py-2 hover:bg-[#0C3C65] hover:rounded-xl transition-all duration-200">Sign Up</a>
      <a href="" class="font-semibold px-5 py-2 bg-[#0C3C65]  rounded-xl hover:bg-white hover:text-[#134686] transition-all duration-200">Log In</a>
    </div>
  </div>
</header>
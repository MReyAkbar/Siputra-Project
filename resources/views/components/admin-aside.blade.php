<aside class="w-64 fixed h-screen bg-[#134686] text-white flex flex-col">
  <div class="px-6 py-6 border-b border-blue-800">
    <div class="flex items-center gap-3">
      <img src="{{ asset("images/siputra-logo.png") }}" class="w-12 h-auto rounded-full" alt="logo siputra">
      <div class="block">
        <h3 class="text-2xl font-bold tracking-tight">SIPUTRA</h3>
        <p class="text-xs opacity-80">Admin Dashboard</p>
      </div>
    </div>
  </div>

  {{-- Menu --}}
  <nav class="flex-1 p-4 space-y-0 overflow-y-scroll [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
    <h3 class="px-3 text-xl mb-2 font-bold">Menu</h3>

    <a href="{{ url('/admin/dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#103a6a] transition-all duration-200">
      <div>
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13 12C13 11.4477 13.4477 11 14 11H19C19.5523 11 20 11.4477 20 12V19C20 19.5523 19.5523 20 19 20H14C13.4477 20 13 19.5523 13 19V12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M4 5C4 4.44772 4.44772 4 5 4H9C9.55228 4 10 4.44772 10 5V12C10 12.5523 9.55228 13 9 13H5C4.44772 13 4 12.5523 4 12V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M4 17C4 16.4477 4.44772 16 5 16H9C9.55228 16 10 16.4477 10 17V19C10 19.5523 9.55228 20 9 20H5C4.44772 20 4 19.5523 4 19V17Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> <path d="M13 5C13 4.44772 13.4477 4 14 4H19C19.5523 4 20 4.44772 20 5V7C20 7.55228 19.5523 8 19 8H14C13.4477 8 13 7.55228 13 7V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round"></path> </g></svg>
      </div>
      <span class="text-lg font-medium">Dashboard</span>
    </a>

    <div>
      <a href="{{ url('/admin/laporan/harian') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#103a6a] transition-all duration-200">
        <div class="flex items-center gap-3">
          <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18.18 8.03933L18.6435 7.57589C19.4113 6.80804 20.6563 6.80804 21.4241 7.57589C22.192 8.34374 22.192 9.58868 21.4241 10.3565L20.9607 10.82M18.18 8.03933C18.18 8.03933 18.238 9.02414 19.1069 9.89309C19.9759 10.762 20.9607 10.82 20.9607 10.82M18.18 8.03933L13.9194 12.2999C13.6308 12.5885 13.4865 12.7328 13.3624 12.8919C13.2161 13.0796 13.0906 13.2827 12.9882 13.4975C12.9014 13.6797 12.8368 13.8732 12.7078 14.2604L12.2946 15.5L12.1609 15.901M20.9607 10.82L16.7001 15.0806C16.4115 15.3692 16.2672 15.5135 16.1081 15.6376C15.9204 15.7839 15.7173 15.9094 15.5025 16.0118C15.3203 16.0986 15.1268 16.1632 14.7396 16.2922L13.5 16.7054L13.099 16.8391M13.099 16.8391L12.6979 16.9728C12.5074 17.0363 12.2973 16.9867 12.1553 16.8447C12.0133 16.7027 11.9637 16.4926 12.0272 16.3021L12.1609 15.901M13.099 16.8391L12.1609 15.901" stroke="#ffffff" stroke-width="1.5"></path> <path d="M8 13H10.5" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 9H14.5" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M8 17H9.5" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M19.8284 3.17157C18.6569 2 16.7712 2 13 2H11C7.22876 2 5.34315 2 4.17157 3.17157C3 4.34315 3 6.22876 3 10V14C3 17.7712 3 19.6569 4.17157 20.8284C5.34315 22 7.22876 22 11 22H13C16.7712 22 18.6569 22 19.8284 20.8284C20.7715 19.8853 20.9554 18.4796 20.9913 16" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
          <span class="text-lg font-medium">Laporan</span>
        </div>
      </a>
    </div>

    <div x-data="{ open: false }" class="mt-2">
      <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-[#103a6a] transition-all duration-200">
        <div class="flex items-center gap-3">
          <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="6" r="4" fill="#ffffff"></circle> <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 22C14.8501 22 14.0251 22 13.5126 21.4874C13 20.9749 13 20.1499 13 18.5C13 16.8501 13 16.0251 13.5126 15.5126C14.0251 15 14.8501 15 16.5 15C18.1499 15 18.9749 15 19.4874 15.5126C20 16.0251 20 16.8501 20 18.5C20 20.1499 20 20.9749 19.4874 21.4874C18.9749 22 18.1499 22 16.5 22ZM17.0833 16.9444C17.0833 16.6223 16.8222 16.3611 16.5 16.3611C16.1778 16.3611 15.9167 16.6223 15.9167 16.9444V17.9167H14.9444C14.6223 17.9167 14.3611 18.1778 14.3611 18.5C14.3611 18.8222 14.6223 19.0833 14.9444 19.0833H15.9167V20.0556C15.9167 20.3777 16.1778 20.6389 16.5 20.6389C16.8222 20.6389 17.0833 20.3777 17.0833 20.0556V19.0833H18.0556C18.3777 19.0833 18.6389 18.8222 18.6389 18.5C18.6389 18.1778 18.3777 17.9167 18.0556 17.9167H17.0833V16.9444Z" fill="#ffffff"></path> <path d="M15.6782 13.5028C15.2051 13.5085 14.7642 13.5258 14.3799 13.5774C13.737 13.6639 13.0334 13.8705 12.4519 14.4519C11.8705 15.0333 11.6639 15.737 11.5775 16.3799C11.4998 16.9576 11.4999 17.6635 11.5 18.414V18.586C11.4999 19.3365 11.4998 20.0424 11.5775 20.6201C11.6381 21.0712 11.7579 21.5522 12.0249 22C12.0166 22 12.0083 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C13.3262 13 14.577 13.1815 15.6782 13.5028Z" fill="#ffffff"></path> </g></svg>
          <span class="font-semibold">Manajemen</span>
        </div>
        <svg class="w-4 h-4 transition-transform duration-200":class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 9l6 6 6-6"/></svg>
      </button>

      <ul x-show="open"
          x-transition:enter="transition ease-out duration-150"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-otu duration-100"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95"
          class="mt-1 ml-5 space-y-0"
          style="display:none">

          <li><a href="{{ url('/admin/manajemen/ikan/data-ikan') }}" class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-[#103a6a] transition-all duration-200">Data Ikan</a></li>
          <li><a href="{{ url('/admin/manajemen/gudang/data-gudang') }}" class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-[#103a6a] transition-all duration-200">Gudang</a></li>
          <li><a href="{{ url('/admin/manajemen/stok/data-stok') }}" class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-[#103a6a] transition-all duration-200">Stok</a></li>
          <li><a href="{{ route('manajemen.pengguna.manage-customer.index') }}" class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-[#103a6a] transition-all duration-200">Pengguna</a></li>
          <li><a href="{{ url('/admin/manajemen/stok/data-stok') }}" class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-[#103a6a] transition-all duration-200">Katalog</a></li>
      </ul>
    </div>

    <div x-data="{ open: false }" class="mt-2">
      <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-[#103a6a] transition-all duration-200">
        <div class="flex items-center gap-3">
          <svg fill="#ffffff" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M17.0020048,13 C17.5542895,13 18.0020048,13.4477153 18.0020048,14 C18.0020048,14.5128358 17.6159646,14.9355072 17.1186259,14.9932723 L17.0020048,15 L5.41700475,15 L8.70911154,18.2928932 C9.0695955,18.6533772 9.09732503,19.2206082 8.79230014,19.6128994 L8.70911154,19.7071068 C8.34862757,20.0675907 7.78139652,20.0953203 7.38910531,19.7902954 L7.29489797,19.7071068 L2.29489797,14.7071068 C1.69232289,14.1045317 2.07433707,13.0928192 2.88837381,13.0059833 L3.00200475,13 L17.0020048,13 Z M16.6128994,4.20970461 L16.7071068,4.29289322 L21.7071068,9.29289322 C22.3096819,9.8954683 21.9276677,10.9071808 21.1136309,10.9940167 L21,11 L7,11 C6.44771525,11 6,10.5522847 6,10 C6,9.48716416 6.38604019,9.06449284 6.88337887,9.00672773 L7,9 L18.585,9 L15.2928932,5.70710678 C14.9324093,5.34662282 14.9046797,4.77939176 15.2097046,4.38710056 L15.2928932,4.29289322 C15.6533772,3.93240926 16.2206082,3.90467972 16.6128994,4.20970461 Z"></path> </g></svg>
          <span class="text-lg font-medium">Transaksi</span>
        </div>
        <svg class="w-4 h-4 transition-transform duration-200":class="{ 'rotate-180': open }" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 9l6 6 6-6"/></svg>
      </button>

      <ul x-show="open"
          x-transition:enter="transition ease-out duration-150"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-out duration-100"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opavity-0 scale-95"
          class="mt-1 ml-5 space-y-0"
          style="display:none">
          <li><a href="{{ url('/admin/transaksi/pembelian/index') }}" class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-[#103a6a] transition-all duration-200">Pembelian</a></li>
          <li><a href="{{ url('/admin/transaksi/penjualan/index') }}" class="block px-4 py-3 rounded-lg text-gray-300 hover:bg-[#103a6a] transition-all duration-200">Penjualan</a></li>
      </ul>
    </div>

    <div class="mt-3">
      @if(auth()->check() && auth()->user()->isManager())
        <a href="{{ route('admin.manage-user.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#103a6a] transition-all duration-200">
          <svg width="25px" height="25px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z" fill="#ffffff"></path> <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#ffffff"></path> </g></svg>
          <span class="font-semibold">Manage Role</span>
        </a>
      @endif

      <a href="{{ url('/admin/aktivitas') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-[#103a6a] transition-all duration-200">
        <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M19 13h-2.15l-3.35 9.213-6-16.5L4.85 13H1v-1h3.15L7.5 2.787l6 16.5L16.15 12H19a2.496 2.496 0 0 0 0 1zm2.5-2a1.5 1.5 0 1 0 1.5 1.5 1.502 1.502 0 0 0-1.5-1.5z"></path><path fill="none" d="M0 0h24v24H0z"></path></g></svg>
        <span class="text-lg font-medium">Aktivitas</span>
      </a>
    </div>
  </nav>

  <div class="px-6 py-4 border-t border-blue-800">
    <a href="{{ route('logout') }}"
      class="flex items-center gap-3 px-4 py-2 bg-[#0C3C65] rounded-xl hover:bg-white hover:text-[#134686] transition-all duration-300 group"
      onclick="event.preventDefault(); this.closest('form').submit();">

        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white group-hover:text-[#134686] transition-colors duration-300">
          <path d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.2429 22 18.8286 22 16.0002 22H15.0002C12.1718 22 10.7576 22 9.87889 21.1213C9.11051 20.3529 9.01406 19.175 9.00195 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
          <path d="M15 12L2 12M2 12L5.5 9M2 12L5.5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="text-lg font-medium">Logout</span>
    </a>

    <form method="POST" action="{{ route('logout') }}" class="hidden">
      @csrf
    </form>
  </div>
</aside>

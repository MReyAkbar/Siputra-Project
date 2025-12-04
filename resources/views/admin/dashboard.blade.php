@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">
  <!-- Header Section -->
  <div class="flex items-center justify-between">
    <div>
      <h2 class="text-3xl font-bold text-gray-800">Dashboard Overview</h2>
      <p class="text-sm text-gray-500 mt-1">Selamat Datang Kembali! Berikut adalah statistik bisnis perusahaan anda.</p>
    </div>
    
    <!-- Period Filter -->
    <div class="bg-white rounded-lg shadow-sm px-4 py-2">
      <select id="periodSelect" class="border-0 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-violet-500 rounded-lg">
        <option value="harian">Harian</option>
        <option value="mingguan">Mingguan</option>
        <option value="bulanan" selected>Bulanan</option>
      </select>
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Total Pembelian Card -->
    <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
      <div class="flex items-start justify-between">
        <div class="flex-1">
          <div class="flex items-center gap-2 mb-2">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="text-sm font-semibold text-red-800">Total Pembelian</p>
          </div>
          <div class="space-y-2">
            <p class="text-3xl font-bold text-gray-800" id="totalPembelian">
              {{ number_format($totalPembelian ?? 0, 0, ',', '.') }} <span class="text-lg">kg</span>
            </p>
            <div class="flex items-center gap-1" id="pembelianChange">
              @if($pembelianChange >= 0)
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                <span class="text-sm font-semibold text-green-600">+{{ number_format($pembelianChange, 1) }}%</span>
              @else
                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
                <span class="text-sm font-semibold text-red-600">{{ number_format($pembelianChange, 1) }}%</span>
              @endif
              <span class="text-xs text-gray-600">vs periode sebelumnya</span>
            </div>
          </div>
        </div>
        <div class="bg-red-200 p-3 rounded-lg">
          <svg class="w-8 h-8 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
          </svg>
        </div>
      </div>
    </div>

    <!-- Total Penjualan Card -->
    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
      <div class="flex items-start justify-between">
        <div class="flex-1">
          <div class="flex items-center gap-2 mb-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            <p class="text-sm font-semibold text-green-800">Total Penjualan</p>
          </div>
          <div class="space-y-2">
            <p class="text-3xl font-bold text-gray-800" id="totalPenjualan">
              {{ number_format($totalPenjualan ?? 0, 0, ',', '.') }} <span class="text-lg">kg</span>
            </p>
            <div class="flex items-center gap-1" id="penjualanChange">
              @if($penjualanChange >= 0)
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                <span class="text-sm font-semibold text-green-600">+{{ number_format($penjualanChange, 1) }}%</span>
              @else
                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
                <span class="text-sm font-semibold text-red-600">{{ number_format($penjualanChange, 1) }}%</span>
              @endif
              <span class="text-xs text-gray-600">vs periode sebelumnya</span>
            </div>
          </div>
        </div>
        <div class="bg-green-200 p-3 rounded-lg">
          <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>
    </div>

    <!-- Kapasitas Tersedia Card -->
    <div class="relative group">
      <div class="bg-gradient-to-br from-violet-50 to-violet-100 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer">
        <div class="flex items-start justify-between">
          <div class="flex-1">
            <div class="flex items-center gap-2 mb-2">
              <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
              </svg>
              <p class="text-sm font-semibold text-violet-800">Kapasitas Tersedia</p>
            </div>
            <div class="space-y-1">
              <p class="text-3xl font-bold text-gray-800">
                {{ number_format($totalKapasitasTersedia ?? 0, 0, ',', '.') }} <span class="text-lg">kg</span>
              </p>
              <p class="text-xs text-gray-600">Sisa ruang di semua gudang</p>
            </div>
          </div>
          <div class="bg-violet-200 p-3 rounded-lg">
            <svg class="w-8 h-8 text-violet-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
            </svg>
          </div>
        </div>

        <!-- Icon "info" kecil di pojok -->
        <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
          <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>

      <!-- Tooltip Detail saat hover -->
      <div class="absolute top-full left-1/2 -translate-x-1/2 mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 pointer-events-none">
        <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-l border-t border-gray-200 rotate-45"></div>
        
        <div class="p-5 space-y-4 relative z-10">
          <h4 class="font-bold text-gray-800 text-sm flex items-center gap-2">
            <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Detail Kapasitas per Gudang
          </h4>

          <div class="space-y-3">
            @forelse($kapasitasGudangTersedia as $gudang)
              <div class="flex items-center justify-between">
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-800">{{ $gudang['nama_gudang'] }}</p>
                  <div class="flex items-center gap-2 mt-1">
                    <div class="flex-1 bg-gray-200 rounded-full h-2">
                      <div class="bg-gradient-to-r from-violet-500 to-violet-600 h-2 rounded-full transition-all duration-500"
                          style="width: {{ $gudang['persentase_terpakai'] }}%"></div>
                    </div>
                    <span class="text-xs text-gray-600 w-12 text-right">
                      {{ $gudang['persentase_terpakai'] }}%
                    </span>
                  </div>
                </div>
                <div class="ml-4 text-right">
                  <p class="text-sm font-bold {{ $gudang['tersedia'] <= 0 ? 'text-red-600' : ($gudang['persentase_terpakai'] >= 90 ? 'text-orange-600' : 'text-green-600') }}">
                    {{ number_format($gudang['tersedia']) }} kg
                  </p>
                  <p class="text-xs text-gray-500">tersedia</p>
                </div>
              </div>
            @empty
              <p class="text-xs text-gray-500 text-center py-2">Tidak ada gudang aktif</p>
            @endforelse
          </div>

          <div class="pt-3 border-t border-gray-100 text-xs text-gray-500 text-center">
            Total kapasitas tersedia: {{ number_format($kapasitasGudangTersedia->sum('terpakai') ?? 0, 0, ',', '.') }} kg
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Chart Section (2 columns) -->
    <div class="lg:col-span-2 space-y-6">
      <!-- Transaction Chart -->
      <div class="bg-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center justify-between mb-6">
          <div>
            <h3 class="text-xl font-bold text-gray-800">Grafik Transaksi</h3>
            <p class="text-sm text-gray-500 mt-1">Perbandingan pembelian dan penjualan</p>
          </div>
          <div class="flex gap-4 text-sm">
            <div class="flex items-center gap-2">
              <div class="w-3 h-3 bg-violet-500 rounded-full"></div>
              <span class="text-gray-600">Pembelian</span>
            </div>
            <div class="flex items-center gap-2">
              <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
              <span class="text-gray-600">Penjualan</span>
            </div>
          </div>
        </div>
        <div class="relative" style="height: 350px;">
          <canvas id="transactionChart"></canvas>
        </div>
      </div>

      <!-- Financial Overview -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Penerimaan Card -->
        <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-green-500">
          <div class="flex items-start justify-between mb-4">
            <div>
              <p class="text-sm text-gray-500 font-medium">Penerimaan</p>
              <p class="text-2xl font-bold text-gray-800 mt-2" id="penerimaan">
                Rp {{ number_format($penerimaan ?? 0, 0, ',', '.') }}
              </p>
            </div>
            <div class="bg-green-100 p-2 rounded-lg">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
          <div class="flex items-center gap-1" id="penerimaanChange">
            @if($penerimaanChange >= 0)
              <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
              </svg>
              <span class="text-sm font-semibold text-green-600">+{{ number_format($penerimaanChange, 1) }}%</span>
            @else
              <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
              <span class="text-sm font-semibold text-red-600">{{ number_format($penerimaanChange, 1) }}%</span>
            @endif
            <span class="text-xs text-gray-500">dari periode sebelumnya</span>
          </div>
        </div>

        <!-- Pengeluaran Card -->
        <div class="bg-white rounded-xl p-6 shadow-lg border-l-4 border-red-500">
          <div class="flex items-start justify-between mb-4">
            <div>
              <p class="text-sm text-gray-500 font-medium">Pengeluaran</p>
              <p class="text-2xl font-bold text-gray-800 mt-2" id="pengeluaran">
                Rp {{ number_format($pengeluaran ?? 0, 0, ',', '.') }}
              </p>
            </div>
            <div class="bg-red-100 p-2 rounded-lg">
              <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
          </div>
          <div class="flex items-center gap-1" id="pengeluaranChange">
            @if($pengeluaranChange >= 0)
              <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
              </svg>
              <span class="text-sm font-semibold text-red-600">+{{ number_format($pengeluaranChange, 1) }}%</span>
            @else
              <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
              <span class="text-sm font-semibold text-green-600">{{ number_format($pengeluaranChange, 1) }}%</span>
            @endif
            <span class="text-xs text-gray-500">dari periode sebelumnya</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Sidebar (1 column) -->
    <aside class="space-y-6">
      <!-- Low Stock Alerts -->
      <div class="bg-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center gap-2 mb-4">
          <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
          <h4 class="font-bold text-gray-800">Peringatan Stok</h4>
        </div>
        <div class="space-y-3">
          @forelse($lowStockAlerts as $alert)
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3">
              <div class="flex justify-between items-start mb-2">
                <p class="text-sm font-semibold text-gray-800">{{ $alert['nama_ikan'] }}</p>
                <span class="text-xs text-amber-700 bg-amber-100 px-2 py-1 rounded-full">
                  {{ number_format($alert['percentage'], 0) }}%
                </span>
              </div>
              <p class="text-xs text-gray-600">{{ $alert['gudang'] }}</p>
              <div class="mt-2 bg-gray-200 rounded-full h-2">
                <div class="bg-amber-500 h-2 rounded-full transition-all duration-300" 
                     style="width: {{ $alert['percentage'] }}%"></div>
              </div>
              <p class="text-xs text-gray-500 mt-1">
                {{ number_format($alert['jumlah']) }} kg (threshold: {{ number_format($alert['threshold']) }} kg)
              </p>
            </div>
          @empty
            <p class="text-sm text-gray-500 text-center py-4">Semua stok dalam kondisi baik</p>
          @endforelse
        </div>
      </div>

      <!-- Top Performers -->
      <div class="bg-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center gap-2 mb-4">
          <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
          </svg>
          <h4 class="font-bold text-gray-800">Top Performers</h4>
        </div>
        <div class="space-y-2" id="topPerformersContainer">
          @forelse($topPerformers as $index => $performer)
            <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg transition-colors">
              <div class="flex items-center gap-3">
                <div class="bg-green-100 text-green-700 font-bold w-7 h-7 rounded-full flex items-center justify-center text-sm">
                  {{ $index + 1 }}
                </div>
                <div>
                  <p class="text-sm font-semibold text-gray-800">{{ $performer->nama }}</p>
                  <p class="text-xs text-gray-500">{{ number_format($performer->total_terjual) }} kg</p>
                </div>
              </div>
              <p class="text-xs font-semibold text-green-600">
                Rp {{ number_format($performer->total_revenue / 1000, 0) }}k
              </p>
            </div>
          @empty
            <p class="text-sm text-gray-500 text-center py-4">Belum ada data penjualan</p>
          @endforelse
        </div>
      </div>

      <!-- Bottom Performers -->
      <div class="bg-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center gap-2 mb-4">
          <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
          </svg>
          <h4 class="font-bold text-gray-800">Perlu Perhatian</h4>
        </div>
        <div class="space-y-2" id="bottomPerformersContainer">
          @forelse($bottomPerformers as $index => $performer)
            <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg transition-colors">
              <div class="flex items-center gap-3">
                <div class="bg-red-100 text-red-700 font-bold w-7 h-7 rounded-full flex items-center justify-center text-sm">
                  {{ $index + 1 }}
                </div>
                <p class="text-sm font-medium text-gray-800">{{ $performer['nama'] }}</p>
              </div>
              <p class="text-xs text-gray-500">{{ number_format($performer['total_terjual']) }} kg</p>
            </div>
          @empty
            <p class="text-sm text-gray-500 text-center py-4">Tidak ada data</p>
          @endforelse
        </div>
      </div>
    </aside>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  let chartInstance = null;
  const ctx = document.getElementById('transactionChart').getContext('2d');

  // Initial chart data from server
  const initialChartData = @json($chartData);

  function formatNumber(num) {
    return new Intl.NumberFormat('id-ID').format(num);
  }

  function formatCurrency(num) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(num);
  }

  function renderPercentageChange(elementId, value) {
    const element = document.getElementById(elementId);
    const isPositive = value >= 0;
    const color = elementId.includes('pengeluaran') 
        ? (isPositive ? 'red' : 'green')
        : (isPositive ? 'green' : 'red');
    
    const arrow = isPositive 
        ? `<svg class="w-4 h-4 text-${color}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
          </svg>`
        : `<svg class="w-4 h-4 text-${color}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
          </svg>`;
    
    element.innerHTML = `
      <div class="flex items-center gap-1">
        ${arrow}
        <span class="text-sm font-semibold text-${color}-600">${isPositive ? '+' : ''}${value}%</span>
        <span class="text-xs text-gray-600">${elementId.includes('Change') ? 'vs periode sebelumnya' : 'dari periode sebelumnya'}</span>
      </div>
    `;
  }

  function initChart(data) {
    if (chartInstance) {
      chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
      type: 'line',
      data: {
        labels: data.labels,
        datasets: [
          {
            label: 'Pembelian (kg)',
            data: data.pembelian,
            borderColor: '#7C3AED',
            backgroundColor: 'rgba(124, 58, 237, 0.1)',
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: '#7C3AED',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            borderWidth: 3
          },
          {
            label: 'Penjualan (kg)',
            data: data.penjualan,
            borderColor: '#F97316',
            backgroundColor: 'rgba(249, 115, 22, 0.1)',
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointHoverRadius: 7,
            pointBackgroundColor: '#F97316',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            borderWidth: 3
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
          mode: 'index',
          intersect: false,
        },
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            padding: 12,
            titleFont: {
              size: 14,
              weight: 'bold'
            },
            bodyFont: {
              size: 13
            },
            callbacks: {
              label: function(context) {
                return context.dataset.label + ': ' + formatNumber(context.parsed.y) + ' kg';
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)',
                drawBorder: false
            },
            ticks: {
              callback: function(value) {
                return formatNumber(value) + ' kg';
              },
              font: {
                size: 11
              }
            }
          },
          x: {
            grid: {
              display: false
            },
            ticks: {
              font: {
                size: 11
              }
            }
          }
        }
      }
    });
  }

  // Initialize chart
  initChart(initialChartData);

  // Period change handler
  document.getElementById('periodSelect').addEventListener('change', async function() {
    const periode = this.value;
    
    // Show loading state
    const chartContainer = document.getElementById('transactionChart').parentElement;
    chartContainer.style.opacity = '0.5';

    try {
      const response = await fetch(`{{ route('admin.dashboard') }}?ajax=1&periode=${periode}`);
      const data = await response.json();

      // Update stats
      document.getElementById('totalPembelian').innerHTML = 
        `${formatNumber(data.transaction_stats.pembelian.current)} <span class="text-lg">kg</span>`;
      document.getElementById('totalPenjualan').innerHTML = 
        `${formatNumber(data.transaction_stats.penjualan.current)} <span class="text-lg">kg</span>`;
      
      document.getElementById('penerimaan').textContent = 
        formatCurrency(data.financial_stats.penerimaan.current);
      document.getElementById('pengeluaran').textContent = 
        formatCurrency(data.financial_stats.pengeluaran.current);

      // Update percentage changes
      renderPercentageChange('pembelianChange', data.transaction_stats.pembelian.change);
      renderPercentageChange('penjualanChange', data.transaction_stats.penjualan.change);
      renderPercentageChange('penerimaanChange', data.financial_stats.penerimaan.change);
      renderPercentageChange('pengeluaranChange', data.financial_stats.pengeluaran.change);

      // Update chart
      initChart(data.chart_data);

      // Update top performers
      const topContainer = document.getElementById('topPerformersContainer');
      if (data.top_performers.length > 0) {
        topContainer.innerHTML = data.top_performers.map((p, i) => `
          <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg transition-colors">
            <div class="flex items-center gap-3">
              <div class="bg-green-100 text-green-700 font-bold w-7 h-7 rounded-full flex items-center justify-center text-sm">
                ${i + 1}
              </div>
              <div>
                <p class="text-sm font-semibold text-gray-800">${p.nama}</p>
                <p class="text-xs text-gray-500">${formatNumber(p.total_terjual)} kg</p>
              </div>
            </div>
            <p class="text-xs font-semibold text-green-600">
                Rp ${formatNumber(p.total_revenue / 1000)}k
            </p>
          </div>
        `).join('');
      } else {
        topContainer.innerHTML = '<p class="text-sm text-gray-500 text-center py-4">Belum ada data penjualan</p>';
      }

      // Update bottom performers
      const bottomContainer = document.getElementById('bottomPerformersContainer');
      if (data.bottom_performers.length > 0) {
        bottomContainer.innerHTML = data.bottom_performers.map((p, i) => `
          <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg transition-colors">
            <div class="flex items-center gap-3">
              <div class="bg-red-100 text-red-700 font-bold w-7 h-7 rounded-full flex items-center justify-center text-sm">
                ${i + 1}
              </div>
              <p class="text-sm font-medium text-gray-800">${p.nama}</p>
            </div>
            <p class="text-xs text-gray-500">${formatNumber(p.total_terjual)} kg</p>
          </div>
        `).join('');
      } else {
        bottomContainer.innerHTML = '<p class="text-sm text-gray-500 text-center py-4">Tidak ada data</p>';
      }

      chartContainer.style.opacity = '1';
    } catch (error) {
      console.error('Error fetching dashboard data:', error);
      chartContainer.style.opacity = '1';
      alert('Gagal memuat data. Silakan coba lagi.');
    }
  });

  document.querySelector('[data-kapasitas-card] .text-3xl').innerHTML = `${formatNumber(data.kapasitas_tersedia.total)} <span class="text-lg">kg</span>`;

  const detailContainer = document.querySelector('[data-kapasitas-card] .mt-4');
  if (data.kapasitas_tersedia.detail.length > 0) {
    detailContainer.innerHTML = data.kapasitas_tersedia.detail.map(g => `
      <div class="flex justify-between items-center">
        <span class="text-gray-600">${g.nama_gudang}</span>
        <span class="font-medium ${g.tersedia <= 0 ? 'text-red-600' : (g.persentase_terpakai >= 90 ? 'text-orange-600' : 'text-green-600')}">
          ${formatNumber(g.tersedia)} kg tersedia
          ${g.status !== 'Tersedia' ? `<span class="ml-1">(${g.status})</span>` : ''}
        </span>
      </div>
    `).join('');
  }
});
</script>
@endsection 
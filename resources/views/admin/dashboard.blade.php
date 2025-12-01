@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
  <div class="mb-6">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>
        <p class="text-sm text-gray-500">Selamat Datang Kembali! Berikut adalah statistik bisnis perusahaan anda.</p>
      </div>
    </div>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
      <div class="bg-white rounded-lg p-4 shadow">
        <div class="flex items-start justify-between">
          <div class="flex-1 space-y-2">
            <p class="text-sm font-semibold text-gray-500">Total Pembelian</p>
            <div class="mt-3 inline-block bg-red-200 rounded-full px-4 py-2">
              <span class="text-gray-800 font-bold text-3xl">
                {{ number_format($totalPembelian ?? 0, 0, ',', '.') }} 
                <span class="text-sm font-bold">kg</span></span>
            </div>
          </div>
          <div>
            <svg width="40px" height="40px" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#6a2929" stroke-width="0.048"></g><g id="SVGRepo_iconCarrier"> <path d="M6.29977 5H21L19 12H7.37671M20 16H8L6 3H3M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg p-4 shadow">
        <div class="flex items-start justify-between">
          <div class="flex-1 space-y-2">  
            <p class="text-sm font-semibold text-gray-500">Total Penjualan</p>
            <div class="mt-3 inline-block bg-green-200 rounded-full px-4 py-2">
              <span class="text-gray-800 font-bold text-3xl">{{ number_format($totalPenjualan ?? 0, 0, ',', '.') }} <span class="text-sm font-bold">kg</span></span>
            </div>
          </div>
          <div>
            <svg fill="#000000" width="40px" height="40px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style> .cls-1 { fill: none; } </style> </defs> <path d="M20,8v2h6.5859L18,18.5859,13.707,14.293a.9994.9994,0,0,0-1.414,0L2,24.5859,3.4141,26,13,16.4141l4.293,4.2929a.9994.9994,0,0,0,1.414,0L28,11.4141V18h2V8Z"></path> <rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"></rect> </g></svg>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg p-4 shadow">
        <div class="flex items-start justify-between">
          <div class="flex-1 space-y-2">
            <p class="text-sm font-semibold text-gray-500">Kapasitas Tersedia</p>
            <div class="mt-3 inline-block bg-violet-200 rounded-full px-4 py-2">
              <span class="text-gray-800 font-bold text-3xl">{{ number_format($kapasitasTersedia ?? 0, 0, ',', '.') }} <span class="text-sm font-bold">kg</span></span>
            </div>
          </div>
          <div>
            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C11.3953 1.25 10.8384 1.40029 10.2288 1.65242C9.64008 1.89588 8.95633 2.25471 8.1049 2.70153L6.03739 3.78651C4.99242 4.33487 4.15616 4.77371 3.51047 5.20491C2.84154 5.65164 2.32632 6.12201 1.95112 6.75918C1.57718 7.39421 1.40896 8.08184 1.32829 8.90072C1.24999 9.69558 1.24999 10.6731 1.25 11.9026V12.0974C1.24999 13.3268 1.24999 14.3044 1.32829 15.0993C1.40896 15.9182 1.57718 16.6058 1.95112 17.2408C2.32632 17.878 2.84154 18.3484 3.51047 18.7951C4.15616 19.2263 4.99241 19.6651 6.03737 20.2135L8.10481 21.2984C8.95628 21.7453 9.64006 22.1041 10.2288 22.3476C10.8384 22.5997 11.3953 22.75 12 22.75C12.6047 22.75 13.1616 22.5997 13.7712 22.3476C14.3599 22.1041 15.0437 21.7453 15.8951 21.2985L17.9626 20.2135C19.0076 19.6651 19.8438 19.2263 20.4895 18.7951C21.1585 18.3484 21.6737 17.878 22.0489 17.2408C22.4228 16.6058 22.591 15.9182 22.6717 15.0993C22.75 14.3044 22.75 13.3269 22.75 12.0975V11.9025C22.75 10.6731 22.75 9.69557 22.6717 8.90072C22.591 8.08184 22.4228 7.39421 22.0489 6.75918C21.6737 6.12201 21.1585 5.65164 20.4895 5.20491C19.8438 4.77371 19.0076 4.33487 17.9626 3.7865L15.8951 2.70154C15.0437 2.25472 14.3599 1.89589 13.7712 1.65242C13.1616 1.40029 12.6047 1.25 12 1.25ZM8.7708 4.04608C9.66052 3.57917 10.284 3.2528 10.802 3.03856C11.3062 2.83004 11.6605 2.75 12 2.75C12.3395 2.75 12.6938 2.83004 13.198 3.03856C13.716 3.2528 14.3395 3.57917 15.2292 4.04608L17.2292 5.09563C18.3189 5.66748 19.0845 6.07032 19.6565 6.45232C19.9387 6.64078 20.1604 6.81578 20.3395 6.99174L17.0088 8.65708L8.50895 4.18349L8.7708 4.04608ZM6.94466 5.00439L6.7708 5.09563C5.68111 5.66747 4.91553 6.07032 4.34352 6.45232C4.06131 6.64078 3.83956 6.81578 3.66054 6.99174L12 11.1615L15.3572 9.48289L7.15069 5.16369C7.07096 5.12173 7.00191 5.06743 6.94466 5.00439ZM2.93768 8.30737C2.88718 8.52125 2.84901 8.76413 2.82106 9.04778C2.75084 9.7606 2.75 10.6644 2.75 11.9415V12.0585C2.75 13.3356 2.75084 14.2394 2.82106 14.9522C2.88974 15.6494 3.02022 16.1002 3.24367 16.4797C3.46587 16.857 3.78727 17.1762 4.34352 17.5477C4.91553 17.9297 5.68111 18.3325 6.7708 18.9044L8.7708 19.9539C9.66052 20.4208 10.284 20.7472 10.802 20.9614C10.9656 21.0291 11.1134 21.0832 11.25 21.1255V12.4635L2.93768 8.30737ZM12.75 21.1255C12.8866 21.0832 13.0344 21.0291 13.198 20.9614C13.716 20.7472 14.3395 20.4208 15.2292 19.9539L17.2292 18.9044C18.3189 18.3325 19.0845 17.9297 19.6565 17.5477C20.2127 17.1762 20.5341 16.857 20.7563 16.4797C20.9798 16.1002 21.1103 15.6494 21.1789 14.9522C21.2492 14.2394 21.25 13.3356 21.25 12.0585V11.9415C21.25 10.6644 21.2492 9.7606 21.1789 9.04778C21.151 8.76412 21.1128 8.52125 21.0623 8.30736L17.75 9.96352V13C17.75 13.4142 17.4142 13.75 17 13.75C16.5858 13.75 16.25 13.4142 16.25 13V10.7135L12.75 12.4635V21.1255Z" fill="#000000"></path> </g></svg>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
      <div class="bg-white h-full rounded-lg p-6 shadow">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold">Grafik Aktivitas</h3>
          <div class="border-b border-gray-200 w-28"></div>
        </div>
        <canvas id="activityChart" class="w-full h-78"></canvas>
      </div>
    </div>

    <aside class="space-y-6">
      <div class="bg-white p-4 rounded-lg shadow">
        <label class="text-sm text-gray-600">Periode</label>
        <select id="periodSelect" class="mt-3 w-full border rounded px-3 py-2">
          <option>Bulanan</option>
          <option>Mingguan</option>
          <option>Tahunan</option>
        </select>
      </div>

      <div class="bg-white p-4 rounded-lg shadow">
        <p class="text-sm text-gray-500">Penerimaan</p>
        <p class="text-2xl font-bold text-gray-800 mt-2">Rp 78.518.938,00 <span class="text-sm text-green-500">+12.5%</span></p>

        <div class="border-t border-gray-100 mt-4 pt-4">
          <p class="text-sm text-gray-500">Pengeluaran</p>
          <p class="text-2xl font-bold text-gray-800 mt-2">Rp 56.852.035,00 <span class="text-sm text-red-500">-8.3%</span></p>
        </div>
      </div>

      <div class="bg-white p-4 rounded-lg shadow">
        <h4 class="font-bold mb-2">Shortcut</h4>
        <ul class="text-sm text-gray-600 space-y-2">
          <li><a href="{{ route('laporan.mingguan') }}" class="hover:underline">Laporan Mingguan</a></li>
          <li><a href="{{ route('admin.stok.index') }}" class="hover:underline">Stok Ikan</a></li>
          <li><a href="{{ route('admin.penjualan.index') }}" class="hover:underline">Penjualan</a></li>
        </ul>
      </div>
    </aside>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Data dari database
    const chartLabels = @json($chartLabels ?? []);
    const chartMasuk = @json($chartMasuk ?? []);
    const chartKeluar = @json($chartKeluar ?? []);

    let chartInstance = null;
    const ctxA = document.getElementById('activityChart').getContext('2d');

    function initChart(labels, masuk, keluar) {
        if (chartInstance) {
            chartInstance.destroy();
        }
        chartInstance = new Chart(ctxA, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Masuk',
                        data: masuk,
                        borderColor: '#7C3AED',
                        backgroundColor: 'rgba(124, 58, 237, 0.12)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        borderWidth: 2
                    },
                    {
                        label: 'Keluar',
                        data: keluar,
                        borderColor: '#F97316',
                        backgroundColor: 'rgba(249, 115, 22, 0.08)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f1f5f9' }
                    },
                    x: {
                        grid: { display: true }
                    }
                }
            }
        });
    }

    // Initialize chart dengan data default (bulanan)
    initChart(chartLabels, chartMasuk, chartKeluar);

    // Event listener untuk perubahan periode
    document.getElementById('periodSelect').addEventListener('change', async function() {
        const periode = this.value.toLowerCase();
        try {
            const response = await fetch(`{{ route('dashboard.chart-data') }}?periode=${periode}`);
            const data = await response.json();
            initChart(data.labels, data.masuk, data.keluar);
        } catch (error) {
            console.error('Error fetching chart data:', error);
        }
    });
  </script>
@endsection

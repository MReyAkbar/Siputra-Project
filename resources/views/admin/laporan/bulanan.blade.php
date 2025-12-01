@extends('layouts.admin')

@section('title', 'Laporan Bulanan - Admin SIPUTRA')

@section('content')
	<div class="min-h-screen bg-gray-50">

		{{-- HEADER --}}
		<div class="bg-white shadow-sm border-b border-gray-200">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
				<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

					<div>
						<h1 class="text-2xl font-bold text-gray-900">Laporan Bulanan</h1>
						<p class="mt-1 text-sm text-gray-600">Ringkasan transaksi setiap bulan (Summary)</p>
					</div>

					<div class="flex items-center gap-3">

						{{-- FILTER --}}
						<div class="flex items-center gap-3">

							{{-- FILTER BULAN–TAHUN --}}
							<form method="GET" action="{{ route('laporan.bulanan') }}" class="flex items-center gap-2">

								{{-- Dropdown Bulan --}}
								<select name="month" class="px-5 pr-7 py-2 rounded-lg border border-gray-300 text-gray-700">
									@foreach(range(1, 12) as $m)
										<option value="{{ sprintf('%02d', $m) }}" {{ $month == sprintf('%02d', $m) ? 'selected' : '' }}>
											{{ \Carbon\Carbon::createFromDate(null, $m, 1)->translatedFormat('F') }}
										</option>
									@endforeach
								</select>

								{{-- Dropdown Tahun --}}
								<select name="year" class="px-5 pr-9 py-2 rounded-lg border border-gray-300 text-gray-700">
									@foreach(range(now()->year - 3, now()->year + 1) as $y)
										<option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
											{{ $y }}
										</option>
									@endforeach
								</select>

								<button class="px-4 py-2 bg-[#134686] text-white rounded-lg hover:bg-[#0f3a66]">
									Terapkan
								</button>
							</form>

						</div>

						{{-- DOWNLOAD --}}
						<button onclick="exportToExcel()"
							class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 transition">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
							</svg>
							Download
						</button>

					</div>

				</div>
			</div>
		</div>

		{{-- TAB NAV --}}
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
			<div class="border-b border-gray-200">
				<nav class="-mb-px flex space-x-8">

					<a href="{{ route('laporan.harian') }}"
						class="py-2 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('laporan.harian') ? 'border-[#134686] text-[#134686]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
						Harian
					</a>

					<a href="{{ route('laporan.mingguan') }}"
						class="py-2 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('laporan.mingguan') ? 'border-[#134686] text-[#134686]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
						Mingguan
					</a>

					<a href="{{ route('laporan.bulanan') }}"
						class="py-2 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('laporan.bulanan') ? 'border-[#134686] text-[#134686]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
						Bulanan
					</a>

				</nav>
			</div>
		</div>

		{{-- CONTENT --}}
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
			<div class="bg-white rounded-xl shadow-lg overflow-hidden">

				<div class="overflow-x-auto">
					<table class="min-w-full divide-y divide-gray-200" id="laporan-table">
						<thead class="bg-gray-50">
							<tr>
								<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">No</th>
								<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Jenis Ikan</th>
								<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Total Pembelian
									(Kg)</th>
								<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Total Penjualan
									(Kg)</th>
								<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Nilai Pembelian
									(Rp)</th>
								<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Nilai Penjualan
									(Rp)</th>
							</tr>
						</thead>

						<tbody class="bg-white divide-y divide-gray-200">
							@foreach($data as $i => $row)
								<tr class="hover:bg-gray-50">

									<td class="px-6 py-4 text-sm text-gray-900">{{ $i + 1 }}</td>

									<td class="px-6 py-4 text-sm text-gray-900">{{ $row['ikan'] }}</td>

									<td class="px-6 py-4 text-sm text-gray-700">
										{{ number_format($row['total_pembelian'], 0, ',', '.') }} kg
									</td>

									<td class="px-6 py-4 text-sm text-gray-700">
										{{ number_format($row['total_penjualan'], 0, ',', '.') }} kg
									</td>

									<td class="px-6 py-4 text-sm text-gray-900">
										Rp {{ number_format($row['nilai_pembelian'], 0, ',', '.') }}
									</td>

									<td class="px-6 py-4 text-sm text-gray-900">
										Rp {{ number_format($row['nilai_penjualan'], 0, ',', '.') }}
									</td>

								</tr>
							@endforeach
						</tbody>

					</table>
				</div>

			</div>
		</div>

	</div>


	{{-- EXPORT --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
	<script>
		function exportToExcel() {
			const table = document.getElementById('laporan-table');
			const wb = XLSX.utils.table_to_book(table, { sheet: "Laporan Bulanan" });
			XLSX.writeFile(wb, `Laporan_Bulanan_SIPUTRA_${new Date().toISOString().slice(0, 10)}.xlsx`);
		}
	</script>

@endsection
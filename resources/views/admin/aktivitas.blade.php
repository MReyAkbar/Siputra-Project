@extends('layouts.admin')

@section('title', 'Aktivitas Sistem')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-bold mb-8 text-gray-900">Aktivitas Sistem</h1>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200" id="data-gudang-table">
                <thead class="bg-gray-50">
                    <tr class="bg-gray-50">

                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Admin
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Detail
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Waktu
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- Data Statis untuk preview --}}
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                    <td class="px-6 py-4 text-left text-sm text-gray-600">data</td>
                </tr>
                
                {{-- Uncomment untuk data dinamis dari database --}}
                {{-- @foreach ($logs as $log)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-6 py-4 text-center text-sm text-gray-600">
                        {{ $log->id }}
                    </td>
                    <td class="px-6 py-4 text-center text-sm text-gray-600">
                        {{ $log->user->name ?? 'Sistem' }}
                    </td>
                    <td class="px-6 py-4 text-center text-sm text-gray-600">
                        {{ $log->activity_type }}
                    </td>
                    <td class="px-6 py-4 text-center text-sm text-gray-600">
                        {{ $log->description }}
                    </td>
                    <td class="px-6 py-4 text-center text-sm text-gray-600">
                        {{ $log->created_at->format('d M Y H:i:s') }}
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
    
    {{-- Pagination --}}
    <div class="mt-6">
        {{ $logs->links() }}
    </div>
</div>
@endsection
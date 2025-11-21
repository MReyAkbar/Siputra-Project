@extends('layouts.admin')

@section('title', 'Aktivitas Sistem')

@section('content')
<div class="p-8">

    <h1 class="text-2xl font-bold mb-8 text-gray-900">Aktivitas Sistem</h1>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-4 text-xs font-medium text-gray-500 uppercase">Admin</th>
                    <th class="px-6 py-4 text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    <th class="px-6 py-4 text-xs font-medium text-gray-500 uppercase">Detail</th>
                    <th class="px-6 py-4 text-xs font-medium text-gray-500 uppercase">Waktu</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @forelse ($logs as $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $log->id }}</td>

                    <td class="px-6 py-4">
                        {{ $log->user->name ?? 'System' }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-blue-700">
                        {{ ucfirst($log->activity_type) }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $log->description }}
                        <br>
                        <span class="text-xs text-gray-500">
                            {{ json_encode($log->data) }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $log->created_at->format('d/m/Y H:i:s') }}
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada aktivitas
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $logs->links() }}
    </div>

</div>
@endsection

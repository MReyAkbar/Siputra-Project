@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-bold">Manajemen Pengguna</h2>
  </div>

  @if(session('status'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
  @endif

  <div class="bg-white shadow rounded overflow-hidden p-4">
    <form method="GET" class="mb-4 flex gap-2 items-center">
      <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name or email" class="border rounded px-3 py-2 w-1/3" />
      <select name="per_page" class="border rounded px-2 py-2">
        @foreach([10,15,25,50] as $n)
          <option value="{{ $n }}" {{ request('per_page', 15) == $n ? 'selected' : '' }}>{{ $n }} / page</option>
        @endforeach
      </select>
      <button class="px-3 py-2 bg-[#0C3C65] text-white rounded">Search</button>
      <a href="{{ route('admin.manage-user.index') }}" class="ml-2">Reset</a>
      <div class="ml-auto flex items-center gap-2">
        <a href="{{ route('admin.manage-user.export', request()->all()) }}" class="px-3 py-2 border rounded">Export CSV</a>
      </div>
    </form>

    <form method="POST" id="bulk-form" action="{{ route('admin.manage-user.bulkDelete') }}">
      @csrf
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
          <thead class="bg-gray-100 text-left">
            <tr>
              <th class="px-4 py-2"><input type="checkbox" id="select-all" /></th>
              <th class="px-4 py-2">@include('admin.manage-user.partials.sort', ['label' => '#', 'field' => 'id'])</th>
              <th class="px-4 py-2">@include('admin.manage-user.partials.sort', ['label' => 'Nama', 'field' => 'name'])</th>
              <th class="px-4 py-2">@include('admin.manage-user.partials.sort', ['label' => 'Email', 'field' => 'email'])</th>
              <th class="px-4 py-2">@include('admin.manage-user.partials.sort', ['label' => 'Terdaftar', 'field' => 'created_at'])</th>
              <th class="px-4 py-2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $user)
            <tr class="border-t">
              <td class="px-4 py-2"><input type="checkbox" name="ids[]" value="{{ $user->id }}" class="select-item" /></td>
              <td class="px-4 py-2">{{ $user->id }}</td>
              <td class="px-4 py-2">{{ $user->name }}</td>
              <td class="px-4 py-2">{{ $user->email }}</td>
              <td class="px-4 py-2">{{ optional($user->created_at)->format('Y-m-d') }}</td>
              <td class="px-4 py-2">
                <a href="{{ route('admin.manage-user.edit', $user->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                <form method="POST" action="{{ route('admin.manage-user.destroy', $user->id) }}" class="inline" onsubmit="return confirm('Hapus pengguna ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="px-4 py-4 text-center">Tidak ada pengguna.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-4 flex items-center gap-2">
        <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded" onclick="return confirm('Hapus semua yang dipilih?')">Hapus Terpilih</button>
        <div class="ml-auto">{{ $users->links() }}</div>
      </div>
    </form>
  </div>
</div>
@endsection

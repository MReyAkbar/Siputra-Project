@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto p-6">
  <h2 class="text-2xl font-bold mb-4">Edit Pengguna</h2>

  @if($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.manage-user.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Nama</label>
      <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2" />
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2" />
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Role</label>
      <select name="role" class="w-full border rounded px-3 py-2">
        @php $current = old('role', $user->role ?? 'customer'); @endphp
        <option value="customer" {{ $current === 'customer' ? 'selected' : '' }}>Customer</option>
        <option value="manager" {{ $current === 'manager' ? 'selected' : '' }}>Manager</option>
        <option value="admin" {{ $current === 'admin' ? 'selected' : '' }}>Admin</option>
      </select>
      @if(auth()->check() && auth()->id() === $user->id)
        <p class="text-xs text-gray-500 mt-1">You cannot change your own role here.</p>
      @endif
    </div>

    <div class="flex items-center gap-3">
      <button class="px-4 py-2 bg-[#0C3C65] text-white rounded">Simpan</button>
      <a href="{{ route('admin.manage-user.index') }}" class="px-4 py-2 border rounded">Batal</a>
    </div>
  </form>
</div>
@endsection

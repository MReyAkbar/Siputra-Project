<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ManageUserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        // Only show admin and manager roles
        $query = User::whereIn('role', ['admin', 'manager', 'customer']);

        // Search
        if ($q = request('q')) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        // Role filter
        if ($role = request('role')) {
            if (in_array($role, ['admin', 'manager', 'customer'])) {
                $query->where('role', $role);
            }
        }

        // Sorting
        $allowedSorts = ['id', 'name', 'email', 'role', 'created_at'];
        $sort = request('sort', 'id');
        $direction = request('direction', 'asc') === 'desc' ? 'desc' : 'asc';
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $perPage = (int) request('per_page', 15);
        if ($perPage <= 0 || $perPage > 200) $perPage = 15;

        $users = $query->orderBy($sort, $direction)->paginate($perPage)->appends(request()->all());

        return view('admin.manage-user.index', compact('users', 'sort', 'direction'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manage-user.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,manager',
        ];

        $data = $request->validate($rules);

        // Prevent changing own role
        if (auth()->id() === $user->id) {
            unset($data['role']);
        }

        $user->update($data);

        return response()->json(['message' => 'User updated.'], 200);
    }

    /**
     * Bulk delete selected users.
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        
        if (empty($ids)) {
            return redirect()->route('admin.manage-user.index')->with('error', 'Tidak ada user yang dipilih.');
        }

        // Prevent deleting current user
        $currentUserId = auth()->id();
        $ids = array_filter($ids, function($id) use ($currentUserId) {
            return $id != $currentUserId;
        });

        if (empty($ids)) {
            return redirect()->route('admin.manage-user.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Check for users with related transactions
        $usersWithTransactions = User::whereIn('id', $ids)
            ->where(function($query) {
                $query->whereHas('pembelian')
                      ->orWhereHas('penjualan');
            })
            ->pluck('name')
            ->toArray();

        if (!empty($usersWithTransactions)) {
            $userNames = implode(', ', $usersWithTransactions);
            return redirect()->route('admin.manage-user.index')
                ->with('error', "User tidak dapat dihapus karena memiliki riwayat transaksi: {$userNames}. Hapus transaksi terkait terlebih dahulu atau nonaktifkan akun.");
        }

        // Delete users
        $deletedCount = User::whereIn('id', $ids)
            ->whereIn('role', ['admin', 'manager'])
            ->delete();

        if ($deletedCount > 0) {
            return redirect()->route('admin.manage-user.index')
                ->with('status', $deletedCount . ' user berhasil dihapus.');
        }

        return redirect()->route('admin.manage-user.index')
            ->with('error', 'Tidak ada user yang dapat dihapus.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting current user
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.manage-user.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Check if user has related transactions
        if ($user->pembelian()->exists() || $user->penjualan()->exists()) {
            return redirect()->route('admin.manage-user.index')
                ->with('error', "User '{$user->name}' tidak dapat dihapus karena memiliki riwayat transaksi. Hapus transaksi terkait terlebih dahulu atau nonaktifkan akun.");
        }

        $userName = $user->name;
        $user->delete();
        
        return redirect()->route('admin.manage-user.index')
            ->with('status', "User '{$userName}' berhasil dihapus.");
    }
}
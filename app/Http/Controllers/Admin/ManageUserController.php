<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $query = User::query();

        // Search
        if ($q = request('q')) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
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
        'role' => 'required|in:customer,admin,manager',
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
        if (!empty($ids)) {
            User::whereIn('id', $ids)->delete();
        }
        return redirect()->route('admin.manage-user.index')->with('status', 'User terpilih dihapus.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect()->route('admin.manage-user.index')->with('status', 'User berhasil dihapus.');
    }
}

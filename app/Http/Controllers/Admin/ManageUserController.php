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
        $direction = request('direction', 'desc') === 'asc' ? 'asc' : 'desc';
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
        if (!is_array($ids) || empty($ids)) {
            return redirect()->back()->with('status', 'No users selected.');
        }

        // Prevent deleting yourself
        $ids = array_filter($ids, function ($id) {
            return $id != auth()->id();
        });

        User::whereIn('id', $ids)->delete();

        return redirect()->route('admin.manage-user.index')->with('status', 'Selected users deleted.');
    }

    /**
     * Export users as CSV according to current filters.
     */
    public function exportCsv()
    {
        $query = User::query();
        if ($q = request('q')) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%");
            });
        }
        if ($role = request('role')) {
            $query->where('role', $role);
        }

        $sort = in_array(request('sort'), ['id', 'name', 'email', 'created_at']) ? request('sort') : 'id';
        $direction = request('direction', 'desc') === 'asc' ? 'asc' : 'desc';

        $users = $query->orderBy($sort, $direction)->get(['id', 'name', 'email', 'role', 'created_at']);

        $filename = 'users_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($users) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID', 'Nama', 'Email', 'Role', 'Terdaftar']);
            foreach ($users as $u) {
                fputcsv($out, [
                    $u->id,
                    $u->name,
                    $u->email,
                    ucfirst($u->role ?? 'customer'),
                    $u->created_at?->format('d/m/Y H:i')
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // prevent deleting yourself
        if (auth()->check() && auth()->id() === $user->id) {
            return redirect()->back()->with('status', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.manage-user.index')->with('status', 'User deleted.');
    }
}

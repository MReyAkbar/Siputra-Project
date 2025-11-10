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

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:customer,admin,manager',
        ]);

        // Prevent managers from changing their own role to avoid accidental lockout
        if (auth()->check() && auth()->id() === $user->id) {
            // remove role from data so they can't change their own role
            unset($data['role']);
        }

        $user->update($data);

        return redirect()->route('admin.manage-user.index')->with('status', 'User updated.');
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
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $users = $query->orderBy('id', 'desc')->get(['id', 'name', 'email', 'role', 'created_at']);

        $filename = 'users_export_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($users) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['id', 'name', 'email', 'role', 'created_at']);
            foreach ($users as $u) {
                fputcsv($out, [$u->id, $u->name, $u->email, $u->role ?? '', $u->created_at]);
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

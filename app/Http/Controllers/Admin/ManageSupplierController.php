<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuppliersExport;

class ManageSupplierController extends Controller
{
     public function index(Request $request)
    {
        $query = Supplier::query();

        if ($q = $request->q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('company', 'like', "%{$q}%");
            });
        }

        $sort = in_array($request->sort, ['id', 'name', 'email', 'company', 'created_at']) ? $request->sort : 'id';
        $direction = $request->direction === 'asc' ? 'asc' : 'desc';

        $perPage = in_array($request->per_page, [10, 15, 25, 50]) ? $request->per_page : 15;

        $suppliers = $query->orderBy($sort, $direction)->paginate($perPage)->appends($request->query());

        return view('admin.manajemen.pengguna.manage-supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.manajemen.pengguna.manage-supplier.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        Supplier::create($validated);

        return redirect()->route('admin.manajemen.pengguna.manage-supplier.index')->with('status', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.manajemen.pengguna.manage-supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        $supplier->update($validated);

        return response()->json(['message' => 'Supplier updated.']);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->back()->with('status', 'Supplier dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Supplier::whereIn('id', $ids)->delete();
        }
        return redirect()->back()->with('status', 'Supplier terpilih dihapus.');
    }

    public function exportCsv(Request $request)
    {
        // Gunakan package Laravel Excel
        return Excel::download(new SuppliersExport($request->all()), 'suppliers_' . now()->format('Ymd_His') . '.csv');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ManageSupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($q = $request->q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_supplier', 'like', "%{$q}%")
                    ->orWhere('no_hp', 'like', "%{$q}%")
                    ->orWhere('alamat', 'like', "%{$q}%");
            });
        }

        $sort = in_array($request->sort, ['id', 'nama_supplier', 'no_hp', 'alamat', 'created_at']) ? $request->sort : 'id';
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
            'nama_supplier' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Supplier::create($validated);

        return response()->json(['message' => 'Customer berhasil ditambahkan.']);
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.manajemen.pengguna.manage-supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $supplier->update($validated);

        return response()->json(['message' => 'Supplier updated.']);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('manajemen.pengguna.manage-supplier.index')->with('status', 'Supplier berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Supplier::whereIn('id', $ids)->delete();
        }
        return redirect()->route('manajemen.pengguna.manage-supplier.index')->with('status', 'Supplier berhasil dihapus.');
    }

    public function exportCsv(Request $request)
    {
        $query = Supplier::query();

        if ($q = $request->q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_supplier', 'like', "%{$q}%")
                    ->orWhere('no_hp', 'like', "%{$q}%")
                    ->orWhere('alamat', 'like', "%{$q}%");
            });
        }

        $sort = in_array($request->sort, ['id', 'nama_supplier', 'no_hp', 'alamat', 'created_at']) ? $request->sort : 'id';
        $direction = $request->direction === 'asc' ? 'asc' : 'desc';

        $customers = $query->orderBy($sort, $direction)->get();

        $filename = 'suppliers_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($customers) {
            $file = fopen('php://output', 'w');
            
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, ['ID', 'Nama Supplier', 'Nomor HP', 'Alamat', 'Tanggal Terdaftar']);

            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->id,
                    $customer->nama_supplier,
                    $customer->no_hp,
                    $customer->alamat,
                    $customer->created_at->format('d/m/Y H:i:s'),
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

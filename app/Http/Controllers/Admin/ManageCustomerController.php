<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ManageCustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($q = $request->q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_customer', 'like', "%{$q}%")
                    ->orWhere('no_hp', 'like', "%{$q}%")
                    ->orWhere('alamat', 'like', "%{$q}%");
            });
        }

        $sort = in_array($request->sort, ['id', 'nama_customer', 'no_hp', 'alamat', 'created_at']) ? $request->sort : 'id';
        $direction = $request->direction === 'desc' ? 'desc' : 'asc';

        $perPage = in_array($request->per_page, [10, 15, 25, 50]) ? $request->per_page : 15;

        $customers = $query->orderBy($sort, $direction)->paginate($perPage)->appends($request->query());

        return view('admin.manajemen.pengguna.manage-customer.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.manajemen.pengguna.manage-customer.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Customer::create($validated);

       return response()->json(['message' => 'Customer berhasil ditambahkan.']);
    }

    public function edit(Customer $customer)
    {
        return view('admin.manajemen.pengguna.manage-customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $customer->update($validated);

        return response()->json(['message' => 'Customer updated.']);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        
        return redirect()->route('manajemen.pengguna.manage-customer.index')->with('status', 'Customer berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Customer::whereIn('id', $ids)->delete();
        }
        return redirect()->route('manajemen.pengguna.manage-customer.index')->with('status', 'Customer terpilih dihapus.');
    }

    public function exportCsv(Request $request)
    {
        $query = Customer::query();

        if ($q = $request->q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_customer', 'like', "%{$q}%")
                    ->orWhere('no_hp', 'like', "%{$q}%")
                    ->orWhere('alamat', 'like', "%{$q}%");
            });
        }

        $sort = in_array($request->sort, ['id', 'nama_customer', 'no_hp', 'alamat', 'created_at']) ? $request->sort : 'id';
        $direction = $request->direction === 'asc' ? 'asc' : 'desc';

        $customers = $query->orderBy($sort, $direction)->get();

        $filename = 'customers_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($customers) {
            $file = fopen('php://output', 'w');
            
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, ['ID', 'Nama Customer', 'Nomor HP', 'Alamat', 'Tanggal Terdaftar']);

            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->id,
                    $customer->nama_customer,
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
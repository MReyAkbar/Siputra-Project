<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;

class ManageCustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

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
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        Customer::create($validated);

        return redirect()->route('admin.manajemen.pengguna.manage-customer.index')->with('status', 'Customer berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        return view('admin.manajemen.pengguna.manage-customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        $customer->update($validated);

        return response()->json(['message' => 'Customer updated.']);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->back()->with('status', 'Customer dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Customer::whereIn('id', $ids)->delete();
        }
        return redirect()->back()->with('status', 'Customer terpilih dihapus.');
    }

    public function exportCsv(Request $request)
    {
        // Gunakan package Laravel Excel
        return Excel::download(new CustomersExport($request->all()), 'customers_' . now()->format('Ymd_His') . '.csv');
    }
}
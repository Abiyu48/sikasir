<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'nullable',
            'alamat' => 'nullable',
        ]);

        Customer::create($request->all());

        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambah');
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'nullable',
            'alamat' => 'nullable',
        ]);

        $customer->update($request->all());

        return redirect()->route('customer.index')->with('success', 'Customer berhasil diupdate');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus');
    }
}

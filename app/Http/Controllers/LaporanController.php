<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Penjualan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk mendapatkan customer dengan total penjualan
        $customers = Customer::withCount('penjualan')
            ->withSum('penjualan', 'total')
            ->with(['penjualan' => function($query) {
                $query->latest()->take(5); // Ambil 5 transaksi terakhir untuk preview
            }])
            ->paginate(10);

        return view('laporan.index', compact('customers'));
    }

    public function show($customerId)
    {
        $customer = Customer::with(['penjualan' => function($query) {
            $query->with(['details.menu', 'user'])
                  ->orderBy('tanggal', 'desc');
        }])->findOrFail($customerId);

        return view('laporan.show', compact('customer'));
    }

    public function detail($penjualanId)
    {
        $penjualan = Penjualan::with(['customer', 'user', 'details.menu'])
            ->findOrFail($penjualanId);

        return view('laporan.detail', compact('penjualan'));
    }
}
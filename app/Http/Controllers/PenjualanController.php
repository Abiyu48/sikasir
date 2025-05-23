<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Customer;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    // Menampilkan list penjualan
    public function index()
    {
        $penjualans = Penjualan::with('customer', 'user')->latest()->get();
        return view('penjualan.index', compact('penjualans'));
    }

    // Form tambah penjualan baru
    public function create()
    {
        $menus = Menu::all();
        $customers = Customer::all();
        return view('penjualan.create', compact('menus', 'customers'));
    }

    // Simpan data penjualan ke database
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $userId = Auth::id(); // Ambil user yang sedang login

            if (!$userId) {
                throw new \Exception("User belum login!");
            }

            // Generate nomor bon unik
            $lastId = Penjualan::max('id') ?? 0;
            $no_bon = 'BON-' . now()->format('Ymd') . '-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

            // Buat header penjualan dulu
            $penjualan = Penjualan::create([
                'no_bon' => $no_bon,
                'tanggal' => now(),
                'customer_id' => $request->customer_id,
                'user_id' => $userId,
                'total' => 0, // akan diupdate nanti
                'metode_pembayaran' => $request->metode_pembayaran ?? 'cash', // contoh default
                'tipe_order' => $request->tipe_order ?? 'dine-in', // contoh default
            ]);

            $total = 0;

            // Loop detail penjualan
            foreach ($request->menu_id as $index => $menu_id) {
                $menu = Menu::find($menu_id);
                if (!$menu) {
                    throw new \Exception("Menu dengan ID {$menu_id} tidak ditemukan.");
                }

                $jumlah = $request->jumlah[$index];
                $harga = $menu->harga; // ambil harga dari menu di DB, bukan dari request untuk keamanan
                $subtotal = $jumlah * $harga;
                $total += $subtotal;

                // Simpan detail penjualan
                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'menu_id' => $menu->id,
                    'jumlah' => $jumlah,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                ]);

                // Update stok menu (kurangi)
                $menu->stok -= $jumlah;
                if ($menu->stok < 0) {
                    throw new \Exception("Stok menu {$menu->nama} tidak mencukupi.");
                }
                $menu->save();
            }

            // Update total harga penjualan
            $penjualan->update(['total' => $total]);

            DB::commit();

            return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    // Tampilkan detail penjualan
    public function show($id)
    {
        $penjualan = Penjualan::with('details.menu', 'customer', 'user')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    // Hapus penjualan dan kembalikan stok
    public function destroy($id)
    {
        $penjualan = Penjualan::with('details')->findOrFail($id);

        // Kembalikan stok barang yang terjual
        foreach ($penjualan->details as $detail) {
            $menu = Menu::find($detail->menu_id);
            if ($menu) {
                $menu->stok += $detail->jumlah;
                $menu->save();
            }
        }

        // Hapus detail dan header penjualan
        $penjualan->details()->delete();
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    }
}

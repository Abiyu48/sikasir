<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::latest()->get();
        return view('pembelian.index', compact('pembelian'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('pembelian.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'supplier' => 'nullable|string|max:255',
            'menu_id.*' => 'required|exists:menus,id',
            'jumlah.*' => 'required|integer|min:1',
            'harga.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $pembelian = Pembelian::create([
                'tanggal' => $request->tanggal,
                'supplier' => $request->supplier,
                'total' => 0, // akan diupdate nanti
            ]);

            $total = 0;

            foreach ($request->menu_id as $index => $menu_id) {
                $jumlah = $request->jumlah[$index];
                $harga = $request->harga[$index];
                $subtotal = $jumlah * $harga;
                $total += $subtotal;

                DetailPembelian::create([
                    'pembelian_id' => $pembelian->id,
                    'menu_id' => $menu_id,
                    'jumlah' => $jumlah,
                    'harga_beli' => $harga,
                ]);

                $menuItem = Menu::find($menu_id);
                $menuItem->stok += $jumlah;
                $menuItem->save();
            }

            $pembelian->update(['total' => $total]);

            DB::commit();
            return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pembelian = Pembelian::with('details.menu')->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }

    public function destroy($id)
    {
        $pembelian = Pembelian::with('details')->findOrFail($id);

        // rollback stok
        foreach ($pembelian->details as $detail) {
            $menu = Menu::find($detail->menu_id);
            $menu->stok -= $detail->jumlah;
            $menu->save();
        }

        $pembelian->details()->delete();
        $pembelian->delete();

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus!');
    }
}

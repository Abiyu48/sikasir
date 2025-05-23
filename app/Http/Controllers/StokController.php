<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class StokController extends Controller
{
    // Menampilkan form edit stok
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('stok.edit', compact('menu'));
    }

    // Menyimpan perubahan stok
    public function update(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->stok = $request->stok;
        $menu->save();

        return redirect()->route('stok.index')->with('success', 'Stok berhasil diupdate!');
    }

    // Jangan lupa buat method index jika belum ada
    public function index()
    {
        $menus = Menu::all();
        return view('stok.index', compact('menus'));
    }
}
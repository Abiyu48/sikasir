<?php

namespace App\Http\Controllers;

use App\Models\Menu;    // <- ini wajib ada supaya bisa panggil model Menu
use App\Models\Kategori; // kalau kamu pakai Kategori juga di controller
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
{
    $menus = Menu::with('kategori')->get();
    return view('menu.index', compact('menus'));
}

public function create()
{
    $kategoris = Kategori::all();
    return view('menu.create', compact('kategoris'));
}

public function store(Request $request)
{
    $data = $request->validate([
        'kategori_id' => 'required|exists:kategoris,id',
        'nama' => 'required',
        'deskripsi' => 'nullable',
        'harga' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('menu', 'public');
    }

    Menu::create($data);

    return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambah');
}

public function edit(Menu $menu)
{
    $kategoris = Kategori::all();
    return view('menu.edit', compact('menu', 'kategoris'));
}

public function update(Request $request, Menu $menu)
{
    $data = $request->validate([
        'kategori_id' => 'required|exists:kategoris,id',
        'nama' => 'required',
        'deskripsi' => 'nullable',
        'harga' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('menu', 'public');
    }

    $menu->update($data);

    return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate');
}

public function destroy(Menu $menu)
{
    $menu->delete();
    return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus');
}

}

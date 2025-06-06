<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Customer;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Kategori;

class TransaksiController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        $menu = Menu::with('kategori')->where('stok', '>', 0)->get();
        $customers = Customer::all();

        $newNoBon = 'BON-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT) . '-' . now()->format('Ymd');

        return view('transaksi.index', compact('kategori', 'menu', 'customers', 'newNoBon'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah' => 'sometimes|integer|min:1'
        ]);

        $menu = Menu::findOrFail($request->menu_id);
        $jumlah = $request->jumlah ?? 1;

        // Cek stok
        if ($menu->stok < $jumlah) {
            return redirect()->back()->with('error', 'Stok menu ' . $menu->nama . ' tidak cukup. Tersedia: ' . $menu->stok);
        }

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$menu->id])) {
            $totalJumlah = $keranjang[$menu->id]['jumlah'] + $jumlah;
            
            // Cek total stok
            if ($menu->stok < $totalJumlah) {
                return redirect()->back()->with('error', 'Stok menu ' . $menu->nama . ' tidak cukup. Tersedia: ' . $menu->stok);
            }
            
            $keranjang[$menu->id]['jumlah'] = $totalJumlah;
        } else {
            $keranjang[$menu->id] = [
                'id' => $menu->id,
                'nama' => $menu->nama,
                'harga' => $menu->harga,
                'jumlah' => $jumlah,
                'kategori' => $menu->kategori->nama ?? 'Lainnya'
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect()->back()->with('success', 'Menu ' . $menu->nama . ' berhasil ditambahkan ke keranjang.');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        $menu = Menu::findOrFail($request->menu_id);
        $keranjang = session()->get('keranjang', []);

        if (!isset($keranjang[$menu->id])) {
            return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang.');
        }

        // Cek stok
        if ($menu->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok menu ' . $menu->nama . ' tidak cukup. Tersedia: ' . $menu->stok);
        }

        $keranjang[$menu->id]['jumlah'] = $request->jumlah;
        session()->put('keranjang', $keranjang);

        return redirect()->back()->with('success', 'Jumlah item berhasil diupdate.');
    }

    public function removeFromCart($id)
    {
        $keranjang = session()->get('keranjang', []);
        
        if (isset($keranjang[$id])) {
            $namaMenu = $keranjang[$id]['nama'];
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
            return redirect()->back()->with('success', 'Menu ' . $namaMenu . ' berhasil dihapus dari keranjang.');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang.');
    }

    public function clearCart()
    {
        session()->forget('keranjang');
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function simpanTransaksi(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'status_pembayaran' => 'required|in:cash,cashless',
            'order_type' => 'required|in:dine_in,take_away',
            'keranjang' => 'required|string'
        ]);

        // Decode keranjang dari JSON
        $keranjangData = json_decode($request->keranjang, true);
        
        if (empty($keranjangData)) {
            return redirect()->back()->with('error', 'Keranjang kosong! Silakan tambahkan menu terlebih dahulu.');
        }

        // Validasi stok sebelum checkout
        foreach ($keranjangData as $item) {
            $menu = Menu::find($item['id']);
            if (!$menu) {
                return redirect()->back()->with('error', 'Menu ' . $item['nama'] . ' tidak ditemukan.');
            }
            if ($menu->stok < $item['jumlah']) {
                return redirect()->back()->with('error', 'Stok menu ' . $menu->nama . ' tidak cukup. Tersedia: ' . $menu->stok);
            }
        }

        $noBon = $request->no_bon;

        // Simpan data checkout ke session
        session()->put('checkout', [
            'keranjang' => $keranjangData,
            'customer_id' => $request->customer_id,
            'no_bon' => $noBon,
            'tanggal' => now()->format('d-m-Y H:i:s'),
            'status_pembayaran' => $request->status_pembayaran,
            'order_type' => $request->order_type,
            'created_at' => now() // Untuk tracking waktu checkout
        ]);

        return redirect()->route('transaksi.checkout');
    }

    public function checkout()
    {
        $checkout = session('checkout');

        if (!$checkout || !isset($checkout['keranjang']) || count($checkout['keranjang']) == 0) {
            return redirect()->route('transaksi.index')->with('error', 'Keranjang kosong. Silakan pilih menu terlebih dahulu.');
        }

        $keranjang = [];

        foreach ($checkout['keranjang'] as $item) {
            $menu = Menu::with('kategori')->find($item['id']);
            if (!$menu || $menu->stok < $item['jumlah']) {
                session()->forget('checkout');
                return redirect()->route('transaksi.index')->with('error', 'Stok menu ' . $item['nama'] . ' sudah berubah. Silakan buat transaksi baru.');
            }

            $keranjang[] = [
                'id'         => $menu->id,
                'nama'       => $menu->nama,
                'harga'      => $menu->harga,
                'jumlah'     => $item['jumlah'],
                'keterangan' => $item['keterangan'] ?? '',
                'kategori'   => $menu->kategori->nama ?? 'Tanpa Kategori',
            ];
        }

        // Ambil data dari session checkout
        $tanggal = $checkout['tanggal'] ?? now()->format('d-m-Y H:i:s');
        $no_bon = $checkout['no_bon'] ?? 'TRX-' . now()->format('YmdHis');
        $metode_pembayaran = $checkout['status_pembayaran'] ?? 'cash';

        // Ambil data customer jika ada
        $customer = null;
        $nama_customer = 'Guest';
        
        if (isset($checkout['customer_id']) && $checkout['customer_id']) {
            $customer = Customer::find($checkout['customer_id']);
            if ($customer) {
                $nama_customer = $customer->nama;
            }
        }

        return view('transaksi.checkout', compact('keranjang', 'tanggal', 'no_bon', 'metode_pembayaran', 'customer', 'nama_customer'));
    }

    public function konfirmasiCheckout(Request $request)
    {
        $checkout = session('checkout');
        
        if (!$checkout || empty($checkout['keranjang'])) {
            return redirect()->route('transaksi.index')->with('error', 'Tidak ada transaksi untuk disimpan.');
        }

        DB::beginTransaction();
        try {
            // Validasi ulang stok
            foreach ($checkout['keranjang'] as $item) {
                $menu = Menu::findOrFail($item['id']);
                if ($menu->stok < $item['jumlah']) {
                    throw new \Exception("Stok untuk menu {$menu->nama} tidak cukup. Tersedia: {$menu->stok}");
                }
            }

            // Buat penjualan
            $userId = auth()->check() ? auth()->id() : null;
            $penjualan = Penjualan::create([
                'customer_id' => $checkout['customer_id'] ?? null,
                'tanggal' => now(),
                'user_id' => $userId,
                'no_bon' => $checkout['no_bon'],
                'total' => 0,
                'status_pembayaran' => $checkout['status_pembayaran'] ?? 'cash',
                'order_type' => $checkout['order_type'] ?? 'dine_in',
            ]);

            $total = 0;
            foreach ($checkout['keranjang'] as $item) {
                $menu = Menu::findOrFail($item['id']);
                
                // Hitung pajak 10%
                $subtotal_before_tax = $item['harga'] * $item['jumlah'];
                $pajak = $subtotal_before_tax * 0.1;
                $subtotal = $subtotal_before_tax + $pajak;

                // Simpan detail penjualan
                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'menu_id' => $item['id'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                    'pajak' => $pajak,
                    'subtotal' => $subtotal,
                ]);

                // Update stok menu
                $menu->decrement('stok', $item['jumlah']);
                
                $total += $subtotal;
            }

            // Update total penjualan
            $penjualan->update(['total' => $total]);

            DB::commit();
            
            // Hapus session checkout dan keranjang
            session()->forget(['checkout', 'keranjang']);

            return redirect()->route('transaksi.struk', $penjualan->id)
                        ->with('success', 'Transaksi berhasil disimpan! No. Bon: ' . $checkout['no_bon']);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function batalkanCheckout()
    {
        session()->forget('checkout');
        return redirect()->route('transaksi.index')->with('info', 'Transaksi dibatalkan.');
    }
    
    public function cetakStruk($id)
    {
        $penjualan = Penjualan::with(['detailPenjualan.menu', 'customer'])
                              ->findOrFail($id);

        return view('transaksi.struk', compact('penjualan'));
    }
}
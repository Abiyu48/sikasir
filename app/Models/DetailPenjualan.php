<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $fillable = ['penjualan_id', 'menu_id', 'jumlah', 'harga'];

    protected $casts = [
        'harga' => 'decimal:2',
        'jumlah' => 'integer'
    ];

    /**
     * Relasi ke penjualan
     */
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    /**
     * Relasi ke menu
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Accessor untuk subtotal
     * Menghitung subtotal dari jumlah * harga
     */
    public function getSubtotalAttribute()
    {
        return $this->jumlah * $this->harga;
    }

    /**
     * Accessor untuk nama menu lengkap
     */
    public function getNamaMenuLengkapAttribute()
    {
        return $this->menu ? $this->menu->nama : 'Menu tidak ditemukan';
    }
}
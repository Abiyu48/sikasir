<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penjualan_id', 
        'menu_id', 
        'jumlah', 
        'harga'
    ];

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
     * Accessor untuk subtotal sebelum pajak
     */
    public function getSubtotalBeforeTaxAttribute()
    {
        return $this->jumlah * $this->harga;
    }

    /**
     * Accessor untuk pajak 10%
     */
    public function getPajakAttribute()
    {
        return ($this->jumlah * $this->harga) * 0.1;
    }

    /**
     * Accessor untuk subtotal termasuk pajak
     */
    public function getSubtotalAttribute()
    {
        $subtotalBeforeTax = $this->jumlah * $this->harga;
        $pajak = $subtotalBeforeTax * 0.1;
        return $subtotalBeforeTax + $pajak;
    }

    /**
     * Accessor untuk nama menu lengkap
     */
    public function getNamaMenuLengkapAttribute()
    {
        return $this->menu ? $this->menu->nama : 'Menu tidak ditemukan';
    }
}
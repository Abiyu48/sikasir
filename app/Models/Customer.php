<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'telepon', 'alamat'];

    /**
     * Relasi ke penjualan
     * Satu customer bisa memiliki banyak penjualan
     */
    public function penjualan()
    {
        return $this->hasMany(\App\Models\Penjualan::class);
    }

    /**
     * Accessor untuk mendapatkan total penjualan customer
     */
    public function getTotalPenjualanAttribute()
    {
        return $this->penjualan()->sum('total');
    }

    /**
     * Accessor untuk mendapatkan jumlah transaksi
     */
    public function getJumlahTransaksiAttribute()
    {
        return $this->penjualan()->count();
    }
}
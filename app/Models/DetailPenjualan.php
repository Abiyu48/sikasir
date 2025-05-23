<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = ['penjualan_id', 'menu_id', 'jumlah', 'harga'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}


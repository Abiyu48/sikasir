<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    public function menu()
{
    return $this->belongsTo(Menu::class);
}
public function pembelian()
{
    return $this->belongsTo(Pembelian::class);
}

}

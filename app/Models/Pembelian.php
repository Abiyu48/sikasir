<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian'; // <- tambahkan baris ini

    protected $fillable = [
        'tanggal', 'supplier', 'total'
    ];
}

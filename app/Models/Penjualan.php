<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Customer;
use App\Models\User;
use App\Models\DetailPenjualan;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'customer_id',
        'user_id',
        'total',
    ];

    // Relasi ke customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi ke user (kasir atau siapa yang input transaksi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke detail penjualan (multiple item)
    public function details()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}

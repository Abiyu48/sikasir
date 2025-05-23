<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Models\Customer; 
use App\Models\User; 
use App\Models\DetailPenjualan;

class Penjualan extends Model { 
    use HasFactory;

    protected $fillable = [ 
        'tanggal', 
        'customer_id', 
        'user_id', 
        'no_bon', 
        'total', 
        'order_type', 
        'status_pembayaran' 
    ];

    protected $casts = [ 
        'tanggal' => 'datetime', 
        'total' => 'decimal:2' 
    ];

    // Relasi ke customer 
    public function customer() { 
        return $this->belongsTo(Customer::class); 
    }

    // Relasi ke user (kasir atau siapa yang input transaksi) 
    public function user() { 
        return $this->belongsTo(User::class); 
    }

    // Relasi ke detail penjualan (multiple item) 
    public function details() { 
        return $this->hasMany(DetailPenjualan::class); 
    }

    // Alias untuk method details agar konsisten dengan controller 
    public function detailPenjualan() { 
        return $this->hasMany(DetailPenjualan::class); 
    }

    // Accessor untuk format tanggal Indonesia 
    public function getFormattedTanggalAttribute() { 
        return $this->tanggal ? $this->tanggal->format('d-m-Y H:i:s') : ''; 
    }

    // Accessor untuk format total dengan rupiah 
    public function getFormattedTotalAttribute() { 
        return 'Rp ' . number_format($this->total, 0, ',', '.'); 
    }

    // Scope untuk filter berdasarkan tanggal 
    public function scopeByDate($query, $date) { 
        return $query->whereDate('tanggal', $date); 
    }

    // Scope untuk filter berdasarkan range tanggal 
    public function scopeByDateRange($query, $startDate, $endDate) { 
        return $query->whereBetween('tanggal', [$startDate, $endDate]); 
    }

    // Scope untuk filter berdasarkan status pembayaran 
    public function scopeByPaymentStatus($query, $status) { 
        return $query->where('status_pembayaran', $status); 
    }

    // Method untuk mendapatkan total item dalam transaksi 
    public function getTotalItemsAttribute() { 
        return $this->details->sum('jumlah'); 
    } 
}
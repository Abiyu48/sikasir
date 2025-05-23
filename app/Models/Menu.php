<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus'; // Pastikan sesuai nama tabel sebenarnya
    
    protected $fillable = [
        'kategori_id',
        'nama',       // nama menu, sesuai kolom di tabel
        'deskripsi',
        'harga',
        'stok',
        'gambar',
    ];

    // Relasi: Menu milik satu Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}

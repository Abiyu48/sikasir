<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'gambar'];

    // Relasi: satu kategori memiliki banyak menu
    public function menus()
    {
        return $this->hasMany(Menu::class, 'kategori_id');
    }
}

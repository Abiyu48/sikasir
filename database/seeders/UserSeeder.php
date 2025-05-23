<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin SiKasir',
            'email' => 'admin@sikasir.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir SiKasir',
            'email' => 'kasir@sikasir.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
        ]);

        User::create([
            'name' => 'Owner SiKasir',
            'email' => 'owner@sikasir.com',
            'password' => Hash::make('owner123'),
            'role' => 'owner',
        ]);
    }
}

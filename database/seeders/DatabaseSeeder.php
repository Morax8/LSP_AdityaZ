<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Kategori::create([
            'nama_kategori' => 'Fasilitas',
        ]);
        Kategori::create([
            'nama_kategori' => 'Kebersihan',
        ]);
        Kategori::create([
            'nama_kategori' => 'Kedisiplinan',
        ]);
        Kategori::create([
            'nama_kategori' => 'Ekstrakulikuler',
        ]);
        Kategori::create([
            'nama_kategori' => 'Lainnya',
        ]);
        User::create([
            'username' => 'Admin',
            'password' => bcrypt('password'),
        ]);
    }
}

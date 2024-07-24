<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RayonTikuSeeder extends Seeder
{
    public function run()
    {
        DB::table('rayon_tiku')->insert([
            ['nama_rayon' => '1A-CACANG', 'kode_rayon' => '53'],
            ['nama_rayon' => '1A-CACANG RENDAH', 'kode_rayon' => '54'],
            
            // Tambahkan data rayon lainnya sesuai kebutuhan
        ]);
    }
}

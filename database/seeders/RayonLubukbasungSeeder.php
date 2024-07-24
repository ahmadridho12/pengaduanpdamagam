<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RayonLubukbasungSeeder extends Seeder
{
    public function run()
    {
        DB::table('rayon_lubukbasung')->insert([
            ['nama_rayon' => '1A-BANDAR BARU', 'kode_rayon' => '3'],
            ['nama_rayon' => 'IB-LUBUAK GADANG', 'kode_rayon' => '4'],
            
            // Tambahkan data rayon lainnya sesuai kebutuhan
        ]);
    }
}

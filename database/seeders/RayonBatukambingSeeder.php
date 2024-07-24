<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RayonBatukambingSeeder extends Seeder
{
    public function run()
    {
        DB::table('rayon_batukambing')->insert([
            ['nama_rayon' => '2B-PUDUNG', 'kode_rayon' => '212'],
            ['nama_rayon' => '2B-DURIAN TINGGALANG', 'kode_rayon' => '71'],
            
            // Tambahkan data rayon lainnya sesuai kebutuhan
        ]);
    }
}

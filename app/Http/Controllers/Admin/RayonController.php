<?php
// app/Http/Controllers/Admin/RayonController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    public function getRayonLubukBasung()
    {
        // Ambil data rayon dari database
        $rayons = [
            ['id' => 1, 'nama_rayon' => 'Rayon 1'],
            ['id' => 2, 'nama_rayon' => 'Rayon 2'],
        ];
        return response()->json($rayons);
    }

    public function getRayonTiku()
    {
        // Ambil data rayon dari database
        $rayons = [
            ['id' => 3, 'nama_rayon' => 'Rayon 3'],
            ['id' => 4, 'nama_rayon' => 'Rayon 4'],
        ];
        return response()->json($rayons);
    }

    // Tambahkan metode lain untuk wilayah yang berbeda
}
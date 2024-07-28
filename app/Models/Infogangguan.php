<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infogangguan extends Model {
   use HasFactory;
    protected $table = 'infogangguan';
    protected $primaryKey = 'id_gangguan';
    protected $fillable = [
        'status',
        'tanggal',
        'judul',
        'deskripsi',


    ];
}

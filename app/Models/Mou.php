<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mou extends Model {
   use HasFactory;
    protected $table = 'mou';
    protected $primaryKey = 'id_mou';
    protected $fillable = [
        'status',
        'nomor',
        'instusi',
        'tgl_ditetapkan',
        'judul',
        'file',
        'tgl_berlaku',
        'tgl_selesai',

    ];
}

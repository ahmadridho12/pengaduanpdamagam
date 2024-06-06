<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'tgl_pengaduan',
        'nama',
        'no_hp',
        'no_index',
        'kode_laporan',
        'judul_laporan',
        'isi_laporan',
        'tgl_kejadian',
        'wilayah_kejadian',
        'lokasi_kejadian',
        'foto',
        'status',
    ];

    protected $dates = [
        'tgl_pengaduan',
        'tgl_kejadian',
    ];

   

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }
}

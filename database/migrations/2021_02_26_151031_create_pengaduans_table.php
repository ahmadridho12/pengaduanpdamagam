<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('pengaduan', function (Blueprint $table) {
        $table->id('id_pengaduan');
        $table->dateTime('tgl_pengaduan');
        $table->string('nama');
        $table->string('no_hp'); // Sekarang hanya kolom biasa, bukan foreign key
        $table->string('no_index'); // Sekarang hanya kolom biasa, bukan foreign key
        $table->string('kode_laporan', 20)->unique(); // Menambahkan kolom kode_laporan yang unik
        $table->enum('judul_laporan', ['air keruh', 'kebocoran', 'meteran', 'pemakaian', 'tidak dapat air', 'lainnya']);
        $table->text('isi_laporan');
        $table->dateTime('tgl_kejadian');
        $table->enum('wilayah_kejadian', ['lubuk basung', 'baso', 'IV angkek', 'maninjau', 'tiku', 'batu kambing', 'matur', 'sungai puar', 'IV koto']);
        $table->text('lokasi_kejadian');
        $table->string('foto');
        $table->enum('status', ['0', 'proses', 'selesai']);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
}

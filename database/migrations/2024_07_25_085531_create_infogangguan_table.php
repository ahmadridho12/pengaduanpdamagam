<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfogangguanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infogangguan', function (Blueprint $table) {
            $table->id('id_gangguan');
            $table->text('judul');
            $table->text('deskripsi');
            $table->datetime('tanggal');
            $table->enum('status', ['aktif', 'proses','selesai']);
            

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
        Schema::dropIfExists('infogangguan');
    }
}

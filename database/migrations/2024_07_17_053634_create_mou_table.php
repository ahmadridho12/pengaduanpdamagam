<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mou', function (Blueprint $table) {
            $table->id('id_mou');
            $table->enum('status', ['Berlaku', 'Perpanjangan', 'Expired']);
            $table->string('nomor');
            $table->string('instusi');
            $table->date('tanggaL_diteteapkan');
            $table->string('judul');
            $table->string('file');
            $table->date('tgl_berlaku');
            $table->date('tgl_selesai');
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
        Schema::dropIfExists('mou');
    }
}

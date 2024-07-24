<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirekturTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direktur', function (Blueprint $table) {
            $table->id('id_direktur');
            $table->enum('status', ['Draft', 'Active', 'Expired']);
            $table->string('nomor');
            $table->date('tgl_ditetapkan');
            $table->string('judul');
            $table->string('file');
            $table->date('tgl_berlaku');
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
        Schema::dropIfExists('direktur');
    }
}

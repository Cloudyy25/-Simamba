<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanTable extends Migration
{
    public function up()
{
    Schema::create('kegiatan', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kegiatan');
        $table->string('tim_kerja');
        $table->date('mulai');
        $table->date('berakhir');
        $table->integer('target');
        $table->integer('realisasi');
        $table->string('satuan');
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('kegiatan');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id('id_notifikasi'); // ID notifikasi sebagai primary key
            $table->dateTime('tanggal_kirim', 0); // Tanggal dan waktu pengiriman
            $table->enum('jenis_notifikasi', ['kegiatan_baru', 'h-10', 'h-5', 'h-3', 'h-2', 'h-1', 'evaluasi']); // Jenis notifikasi
            $table->boolean('status'); // Status dibaca (true/false)
            $table->text('pesan'); // Pesan notifikasi

            $table->unsignedBigInteger('id_user'); // Relasi ke user
            $table->unsignedBigInteger('id_kegiatan')->nullable(); // Relasi ke kegiatan (opsional)

            // Relasi foreign key
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->foreign('id_kegiatan')->references('id')->on('kegiatans')->onDelete('set null'); // Relasi ke tabel kegiatans
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};

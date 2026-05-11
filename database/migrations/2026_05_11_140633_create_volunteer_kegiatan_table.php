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
        Schema::create('volunteer_kegiatan', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('kategori_id')->nullable();
    $table->string('judul', 200);
    $table->text('deskripsi');
    $table->string('penyelenggara', 150);
    $table->string('lokasi', 200)->nullable();
    $table->date('tanggal_mulai');
    $table->date('tanggal_selesai')->nullable();
    $table->time('jam_mulai')->nullable();
    $table->time('jam_selesai')->nullable();
    $table->integer('kuota')->nullable();
    $table->text('syarat')->nullable();
    $table->string('gambar_url', 500)->nullable();
    $table->enum('status', ['aktif', 'penuh', 'selesai', 'dibatalkan'])->default('aktif');
    $table->unsignedBigInteger('created_by')->nullable();
    $table->timestamps();
    $table->foreign('kategori_id')->references('id')->on('kategori_event')->onDelete('set null');
    $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_kegiatan');
    }
};

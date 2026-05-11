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
        Schema::create('volunteer_sertifikat', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('pendaftaran_id');
    $table->unsignedBigInteger('user_id');
    $table->unsignedInteger('kegiatan_id');
    $table->string('nama_penerima', 150);
    $table->string('nik_nim', 50)->nullable();
    $table->string('institusi', 200)->nullable();
    $table->string('nomor_sertifikat', 100)->nullable();
    $table->date('tanggal_terbit')->nullable();
    $table->string('file_url', 500)->nullable();
    $table->timestamp('created_at')->useCurrent();
    $table->unique('pendaftaran_id');
    $table->foreign('pendaftaran_id')->references('id')->on('volunteer_pendaftaran')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('kegiatan_id')->references('id')->on('volunteer_kegiatan')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_sertifikat');
    }
};

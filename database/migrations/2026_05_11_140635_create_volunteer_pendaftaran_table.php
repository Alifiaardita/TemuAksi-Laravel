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
        Schema::create('volunteer_pendaftaran', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedBigInteger('user_id');
    $table->unsignedInteger('kegiatan_id');
    $table->string('nama_lengkap', 150);
    $table->string('no_telepon', 20)->nullable();
    $table->string('email', 255)->nullable();
    $table->text('motivasi')->nullable();
    $table->text('pengalaman')->nullable();
    $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'selesai'])->default('menunggu');
    $table->text('catatan_admin')->nullable();
    $table->timestamps();
    $table->unique(['user_id', 'kegiatan_id']);
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('kegiatan_id')->references('id')->on('volunteer_kegiatan')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_pendaftaran');
    }
};

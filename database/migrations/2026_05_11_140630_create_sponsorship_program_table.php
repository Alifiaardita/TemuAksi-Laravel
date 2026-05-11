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
        Schema::create('sponsorship_program', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('sponsor_id');
    $table->string('judul', 200)->nullable();
    $table->text('deskripsi')->nullable();
    $table->integer('min_dana')->nullable();
    $table->integer('max_dana')->nullable();
    $table->date('periode_mulai')->nullable();
    $table->date('periode_selesai')->nullable();
    $table->string('batas_pengajuan', 50)->nullable();
    $table->string('estimasi_respon', 50)->nullable();
    $table->string('skala_event', 50)->nullable();
    $table->integer('min_peserta')->nullable();
    $table->text('benefit')->nullable();
    $table->text('portofolio')->nullable();
    $table->timestamp('created_at')->useCurrent();
    $table->foreign('sponsor_id')->references('id')->on('sponsor')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsorship_program');
    }
};

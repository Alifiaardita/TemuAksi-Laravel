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
        Schema::create('proposal', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedBigInteger('user_id');
    $table->unsignedInteger('sponsor_id');
    $table->string('judul', 200);
    $table->text('deskripsi');
    $table->string('kategori', 100)->nullable();
    $table->string('lokasi', 100)->nullable();
    $table->date('tanggal')->nullable();
    $table->integer('target_dana')->nullable();
    $table->enum('status', ['terkirim', 'pendanaan', 'selesai', 'ditolak'])->default('terkirim');
    $table->string('file_proposal', 255)->nullable();
    $table->timestamp('created_at')->useCurrent();
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('sponsor_id')->references('id')->on('sponsor')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal');
    }
};

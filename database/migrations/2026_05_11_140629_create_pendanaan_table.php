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
        Schema::create('pendanaan', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('proposal_id')->nullable();
    $table->unsignedBigInteger('perusahaan_id')->nullable();
    $table->integer('jumlah_dana')->nullable();
    $table->timestamp('tanggal')->useCurrent();
    $table->foreign('proposal_id')->references('id')->on('proposal');
    $table->foreign('perusahaan_id')->references('id')->on('users');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendanaan');
    }
};

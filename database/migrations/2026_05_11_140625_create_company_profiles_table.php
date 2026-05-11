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
    Schema::create('company_profiles', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('user_id')->unique();
    $table->string('nama_perusahaan', 200);
    $table->text('deskripsi')->nullable();
    $table->string('bidang_industri', 100)->nullable();
    $table->string('no_telepon', 20)->nullable();
    $table->text('alamat')->nullable();
    $table->string('website', 255)->nullable();
    $table->string('ttd_stempel_url', 500)->nullable();
    $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};

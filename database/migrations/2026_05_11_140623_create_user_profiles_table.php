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
        Schema::create('user_profiles', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('user_id')->unique();
    $table->string('nama_lengkap', 150);
    $table->string('no_telepon', 20)->nullable();
    $table->string('avatar_url', 500)->nullable();
    $table->string('username', 100)->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('gender', 20)->nullable();
    $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};

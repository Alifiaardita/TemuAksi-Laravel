<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('volunteer_kegiatan', function (Blueprint $table) {
            $table->string('divisi', 255)->nullable()->after('syarat');
            $table->string('kontak', 255)->nullable()->after('divisi');
            $table->text('benefit')->nullable()->after('kontak');
            $table->string('cara_seleksi', 50)->nullable()->after('benefit');
            $table->date('deadline_daftar')->nullable()->after('cara_seleksi');
        });
    }

    public function down(): void
    {
        Schema::table('volunteer_kegiatan', function (Blueprint $table) {
            $table->dropColumn(['divisi', 'kontak', 'benefit', 'cara_seleksi', 'deadline_daftar']);
        });
    }
};
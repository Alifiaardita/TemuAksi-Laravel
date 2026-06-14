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
        Schema::table('sponsor', function (Blueprint $table) {
            $table->string('wilayah')->nullable()->after('lokasi');
            $table->json('syarat')->nullable()->after('wilayah');
            $table->json('dokumen')->nullable()->after('syarat');
            $table->json('benefit')->nullable()->after('dokumen');
        });
    }

    public function down(): void
    {
        Schema::table('sponsor', function (Blueprint $table) {
            $table->dropColumn(['wilayah', 'syarat', 'dokumen', 'benefit']);
        });
    }
};

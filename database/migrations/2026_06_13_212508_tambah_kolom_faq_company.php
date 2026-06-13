<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('faq_company', function (Blueprint $table) {
        $table->string('pertanyaan')->after('id');
        $table->text('jawaban')->after('pertanyaan');
    });
}

public function down()
{
    Schema::table('faq_company', function (Blueprint $table) {
        $table->dropColumn(['pertanyaan', 'jawaban']);
    });
}
};

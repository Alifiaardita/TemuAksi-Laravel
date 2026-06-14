<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE faq_company CHANGE `jawaban` `detail` TEXT');
    }

    public function down()
    {
        DB::statement('ALTER TABLE faq_company CHANGE `detail` `jawaban` TEXT');
    }
};

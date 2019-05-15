<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InfoDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hm_infos', function (Blueprint $table) {
            $table->text('description')->comment('Описание компании')->nullable()->after('weekend');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hm_infos', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}

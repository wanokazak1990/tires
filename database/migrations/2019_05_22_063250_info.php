<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Info extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hm_infos', function (Blueprint $table) {
            $table->string('tg_token')->nullable();
            $table->string('tg_chat')->nullable();
            $table->string('tg_proxy')->nullable();
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
            //
        });
    }
}

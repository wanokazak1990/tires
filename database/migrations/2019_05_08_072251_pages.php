<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hm_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('Заголовок страницы')->nullable();
            $table->string('alias')->comment('Псевдоним')->nullable();
            $table->text('text')->comment('Содержимое')->nullable();
            $table->string('img')->comment('Картинка')->nullable();
            $table->integer('status')->comment('Статус')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hm_pages');
    }
}

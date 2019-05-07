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
        Schema::create('hm_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Название сайта');
            $table->string('slogan')->comment('Слоган сайта');
            $table->string('phone')->comment('Телефон компании');
            $table->string('address')->comment('Адрес компании');
            $table->string('hours')->comment('Часы работы');
            $table->string('weekend')->comment('Выходные дни');
            $table->string('admin_email')->comment('Адрес почты админа')->nullable();
            $table->string('vk_group')->comment('Ссылка на группу в ВК')->nullable();
            $table->string('logo')->comment('Основной логотип')->nullable();
            $table->string('title_icon')->comment('Иконка в заголовке сайта')->nullable();
            $table->string('map_code')->comment('Код карты для сайта')->nullable();
            $table->string('metrics_code')->comment('Код метрики для сайта')->nullable();
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
        Schema::dropIfExists('hm_infos');
    }
}

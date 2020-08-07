<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillLargeCategoriesTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        // 大スキルカテゴリテーブル
        Schema::create('skill_large_categories', function (Blueprint $table) {
            $table->increments('id');    // 大スキルカテゴリID
            $table->string('name', 100); // 大スキルカテゴリ名
        });
    }

    /**
     * マイグレーションを元に戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('skill_large_categories');
    }
}
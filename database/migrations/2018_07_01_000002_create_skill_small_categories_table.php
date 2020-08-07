<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillSmallCategoriesTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        //　小スキルカテゴリテーブル
        Schema::create('skill_small_categories', function (Blueprint $table) {
            $table->increments('id');                  // 小スキルカテゴリID
            $table->string('name', 100);               // 小スキルカテゴリ名
            $table->integer('skill_large_category_id') // 大スキルカテゴリID
                ->unsigned()
                ->index();

            $table->foreign('skill_large_category_id')
                ->references('id')
                ->on('skill_large_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * マイグレーションを元に戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('skill_small_categories');
    }
}
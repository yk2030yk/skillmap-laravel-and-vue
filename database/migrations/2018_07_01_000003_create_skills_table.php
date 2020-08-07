<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        //　スキルテーブル
        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');                  // スキルID
            $table->string('name', 100);               // スキル名
            $table->integer('skill_small_category_id') // 小スキルカテゴリID
                ->unsigned()
                ->index();

            $table->foreign('skill_small_category_id')
                ->references('id')
                ->on('skill_small_categories')
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
        Schema::drop('skills');
    }
}
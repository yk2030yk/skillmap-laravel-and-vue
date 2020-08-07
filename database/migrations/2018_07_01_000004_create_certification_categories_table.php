<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificationCategoriesTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        // 資格カテゴリテーブル
        Schema::create('certification_categories', function (Blueprint $table) {
            $table->increments('id');    // 資格カテゴリID
            $table->string('name', 100); // 資格カテゴリ名
        });
    }

    /**
     * マイグレーションを元に戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('certification_categories');
    }
}
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificationsTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        // 資格テーブル
        Schema::create('certifications', function (Blueprint $table) {
            $table->increments('id');                    // 資格ID
            $table->string('name', 100);                 // 資格名
            $table->integer('certification_category_id') // 資格カテゴリID
                ->unsigned()
                ->index();

            $table->foreign('certification_category_id')
                ->references('id')
                ->on('certification_categories')
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
        Schema::drop('certifications');
    }
}
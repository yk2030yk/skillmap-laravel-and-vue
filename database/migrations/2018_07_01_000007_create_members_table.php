<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        // 社員テーブル
        Schema::create('members', function (Blueprint $table) {
            $table->char('id', 6)        // 社員番号
                ->primary();
            $table->string('name', 30); // 社員名
            $table->integer('team_id')   // 小スキルカテゴリID
                ->unsigned()
                ->index();

            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
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
        Schema::drop('members');
    }
}
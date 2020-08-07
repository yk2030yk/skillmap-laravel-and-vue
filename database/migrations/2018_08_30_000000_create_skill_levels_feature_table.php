<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillLevelsFeatureTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        // スキルレベルテーブル
        Schema::create('skill_levels_feature', function (Blueprint $table) {
            $table->increments('id');       // スキルレベルID
            $table->integer('level')        // スキルレベル
                ->default(0)
                ->comment('スキルレベル');
            $table->char('member_id', 6)    // 社員ID
                ->index();
            $table->integer('skill_id')     // スキルID
                ->unsigned()
                ->index();
            $table->timestamp('created_at') // 作成日時
                ->useCurrent();
            $table->timestamp('updated_at') // 更新日時
                ->useCurrent();

            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('cascade');
            $table->foreign('skill_id')
                ->references('id')
                ->on('skills')
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
        Schema::drop('skill_levels_feature');
    }
}
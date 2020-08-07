<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificationStatusTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        // 資格取得状況テーブル
        Schema::create('certification_status', function (Blueprint $table) {
            $table->increments('id');           // 資格取得状況ID
            $table->char('member_id', 6)        // 社員ID
                ->index();
            $table->integer('certification_id') // スキルID
                ->unsigned()
                ->index();
            $table->timestamp('created_at')     // 作成日時
                ->useCurrent();
            $table->timestamp('updated_at')     // 更新日時
                ->useCurrent();

            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('cascade');
            $table->foreign('certification_id')
                ->references('id')
                ->on('certifications')
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
        Schema::drop('certification_status');
    }
}
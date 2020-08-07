<?php

use Illuminate\Database\Seeder;

class SkillLargeCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_names = [
            'システム・アーキテクチャ構築',
            'アプリケーション開発',
            'マネジメント',
            '商品企画',
            'システム運用',
            'デザイン・UI/UX',
            'マーケティング・分析',
            '商習慣（業務知識）'
        ];
        
        $data = [];
        foreach ($category_names as $name) {
            $data[] = ['name' => $name];
        }
        DB::table('skill_large_categories')->insert($data);
    }
}

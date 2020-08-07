<?php

use Illuminate\Database\Seeder;

class SkillSmallCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skill_small_category_names = [
            'システム・アーキテクチャ構築'
                => ['OS','AWS','その他Cloud','ネットワーク','その他(システム・アーキテクチャ)'],
            'アプリケーション開発'
                => ['プログラム言語','データベース','サーバー','フロント','フレームワーク','ライブラリ','アプリ','開発手法','テスト手法','その他(開発)'],
            'マネジメント'
                => ['PMBOK','リーダーシップ','チームビルディング'],
            '商品企画'
                => ['プレゼン','企画書','ビジネスモデル'],
            'システム運用'
                => ['ツール','セキュリティ'],
            'デザイン・UI/UX'
                => ['ブラウザ知識','画像処理','色彩','ワイヤーフレーム','デザイン'],
            'マーケティング・分析'
                => ['SEO/SEM','アドテク','SNS','コンテンツマーケティング','Webアクセス解析','LPO','EFO'],
            '商習慣（業務知識）'
                => ['住宅不動産','商法','財務分析','エバンジェリスト']
        ];
        $skill_large_categories = DB::table('skill_large_categories')->get();
        
        $data = [];
        foreach ($skill_large_categories as $skill_large_category) {
            $skill_small_categories = $skill_small_category_names[$skill_large_category->name];
            foreach ($skill_small_categories as $name) {
                 $data[] = [
                    'name' => $name,
                    'skill_large_category_id' => $skill_large_category->id,
                ];
            }
        }
        DB::table('skill_small_categories')->insert($data);
    }
}

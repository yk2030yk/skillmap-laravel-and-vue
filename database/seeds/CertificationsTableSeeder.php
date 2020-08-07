<?php

use Illuminate\Database\Seeder;

class CertificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $certification_names = [
            'linux'
                => ['LPIC level1','LPIC level2','LPIC level3'],
            'AWS'
                => ['クラウドプラクティショナー','ソリューションアーキテクト – アソシエイト','ソリューションアーキテクト – プロフェッショナル',
                    'デベロッパー – アソシエイト','DevOps エンジニア – プロフェッショナル','SysOps アドミニストレーター – アソシエイト',
                    'DevOps エンジニア – プロフェッショナル','ビッグデータ – 専門知識','高度なネットワーク – 専門知識','セキュリティ – 専門知識'],
            '情報処理'
                => ['基本情報処理（情報処理二種）','応用情報（ソフトウエア開発）','ITストラテジスト','システムアーキテクト','プロジェクトマネージャ',
                    'ネットワークスペシャリスト','データベーススペシャリスト','エンベデッドシステムスペシャリスト','ITサービスマネージャ',
                    'システム監査','ITパスポート（初級アドミニストレータ）','情報セキュリティマネジメント','登録セキスペ'],
            'Java'
                => ['Java Programmer','Web Component Developer','Java Silver','Java Gold'],
            'PHP'
                => ['PHP5 初級','PHP5 上級','Zend PHP Certification'],
            'Ruby'
                => ['Ruby Programmer Silver','Ruby Programmer Gold'],
            'HTML'
                => ['HTML5プロフェッショナル認定資格 レベル1','HTML5プロフェッショナル認定資格 レベル2'],
            'データベース'
                => ['Oracle 9i Silver','Oracle 9i Gold','Oracle 10g Bronze','Oracle 10g Silver','Oracle 10g Gold','Oracle 10g Platinum',
                    'Oracle 11g Bronze','Oracle 11g Sliver','Oracle 11g Gold','Oracle 11g Platinum'],
            '業務知識'
                => ['税理士','中小企業診断士','社労士','販売士一級','宅地建物取引士','日商簿記一級','日商簿記二級'],
            'その他'
                => ['PMP','Android 技術者認定試験ベーシック','MCA Database','品質管理検定3級','シスコ技術者認定','スクラムマスター'],
        ];
        
        $certification_categories = DB::table('certification_categories')->get();
        $data = [];
        foreach ($certification_categories as $category) {
            $certifications = $certification_names[$category->name];
            foreach ($certifications as $name) {
                $data[] = [
                    'name' => $name,
                    'certification_category_id' => $category->id
                ];
            }
        }
        DB::table('certifications')->insert($data);
    }
}

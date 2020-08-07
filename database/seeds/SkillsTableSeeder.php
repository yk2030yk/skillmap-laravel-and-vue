<?php

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skill_names = [
            'OS' 
                => ['linux','Windows','iOS','Android'],
            'AWS'
                => ['EC2','ELB','Lambda','S3','EBS','Aurora','RDS','VPC','Route 53','API Gateway','Kinesis','RedShift'],
            'その他Cloud'
                => ['Google Cloud Platform（GCP）','Microsoft Azure','IIJ GIO','Heroku','IBM bluemix','クラウディナリー','ネットリフィー','githubpages'],
            'ネットワーク'
                => ['TCP/IP','http','https'],
            'その他(システム・アーキテクチャ)'
                => ['デザインパターン','ターミナル作業','Jenkins','Git(GitHub,Stash)','Subversion','CVS'],
            'プログラム言語'
                => ['Java','PHP','SQL','Ruby','C#','C++','Perl','python'],
            'データベース'
                => ['Oracle','MySQL','PostgreSQL'],
            'サーバー'
                => ['sh','csh','bash'],
            'フロント'
                => ['html','js','css'],
            'フレームワーク'
                => ['zend2','Laravel','FuelPHP','Ruby on Rails'],
            'ライブラリ'
                => ['jQuery','Typescript','Vuejs','Angular','nodejs','sass'],
            'アプリ'
                => ['Swift','Kotolin','ionic','Onsen'],
            '開発手法'
                => ['ウォーターフォール','アジャイル','TDD（テスト駆動）','DevOps','ChatOps'],
            'テスト手法'
                => ['UnitTest','Selenium','nightwatch.js'],
            'その他(開発)'
                => ['Unity','Unreal Engine'],
            'PMBOK'
                => ['統合マネジメント','スコープマネジメント','スケジュールマネジメント','コストマネジメント','品質マネジメント','人的資源マネジメント','コミュニケーションマネジメント','リスクマネジメント','調達マネジメント','ステークホルダーマネジメント'],
            'リーダーシップ'
                => ['テクニカルスキル（業務遂行能力）','ヒューマンスキル（対人関係能力）','コンセプチュアルスキル（概念化能力）'],
            'チームビルディング'
                => ['タックマンモデル','DLTG'],
            'プレゼン'
                => ['ABCDストラクチャー','PowerPoint'],
            '企画書'
                => ['3C/4C分析','SWOT分析'],
            'ビジネスモデル'
                => ['シンブル物販パターン','広告パターン'],
            'ツール'
                => ['JP1','cron','zabbix','マカレル'],
            'セキュリティ'
                => ['VEX','脆弱性対策'],
            'ブラウザ知識'
                => ['レンダリング','アクセシビリティ'],
            '画像処理'
                => ['Photoshop','Illustrator'],
            '色彩'
                => ['発色方法','色の種類'],
            'ワイヤーフレーム'
                => ['Cacoo','UXPIN'],
            'デザイン'
                => ['マテリアルデザイン','レスポンシブデザイン','Atomic Design'],
            'SEO/SEM'
                => ['モバイルファーストインデックス(MFI)','アダプティブデザイン','HTTP/2','ログファイル分析','AMP／PWA'],
            'アドテク'
                => ['アドネットワーク','アトリビューション分析'],
            'SNS'
                => ['Facebook','Twitter'],
            'コンテンツマーケティング'
                => ['CMS', 'カスタマージャーニーマップ'],
            'Webアクセス解析'
                => ['Google Analytics','Google タグマネージャ','Google Search Console','KAIZEN','VWO','BigQuery'],
            'LPO'
                => ['行動ターゲティングLPO','エリアターゲティングLPO'],
            'EFO'
                => ['formy','canataEFO'],
            '住宅不動産'
                => ['仲介業務','管理業務'],
            '商法'
                => ['会社法','商行為法'],
            '財務分析'
                => ['貸借対照保表','損益計算書'],
            'エバンジェリスト'
                => ['イベントやセミナーでの講演','執筆活動']
        ];
        $skill_small_categories = DB::table('skill_small_categories')->get();
        
        $data = [];
        foreach ($skill_small_categories as $skill_small_category) {
            $skills = $skill_names[$skill_small_category->name];
            foreach ($skills as $name) {
                 $data[] = [
                    'name' => $name,
                    'skill_small_category_id' => $skill_small_category->id,
                ];
            }
        }
        DB::table('skills')->insert($data);
    }
}

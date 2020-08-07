<?php

use Illuminate\Database\Seeder;

class CertificationCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_names = [
            'linux',
            'AWS',
            '情報処理',
            'Java',
            'PHP',
            'Ruby',
            'HTML',
            'データベース',
            '業務知識',
            'その他',
        ];
        
        $data = [];
        foreach ($category_names as $name) {
            $data[] = ['name' => $name];
        }
        DB::table('certification_categories')->insert($data);
    }
}

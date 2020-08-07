<?php

use Illuminate\Database\Seeder;

class SkillLevelsFeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skill_levels = DB::table('skill_levels')->get();
        
        $data = [];
        foreach ($skill_levels as $sl) {
            $lv = $sl->level;
            if (rand(1, 1000) % 50 == 0) {
                $lv = $lv < 5 ? $lv + 1 : $lv;
            }
            $data[] = [
                'member_id' => $sl->member_id,
                'skill_id'  => $sl->skill_id,
                # ランダムにレベルを設定
                'level'     => $lv,
            ];
        }
        DB::table('skill_levels_feature')->insert($data);
    }
}

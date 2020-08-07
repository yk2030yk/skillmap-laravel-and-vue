<?php

use Illuminate\Database\Seeder;

class SkillLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = DB::table('members')->get();
        $skills  = DB::table('skills')->get();
        
        $data = [];
        foreach ($members as $member) {
            foreach ($skills as $skill) {
                $data[] = [
                    'member_id' => $member->id,
                    'skill_id'  => $skill->id,
                    # ランダムにレベルを設定
                    'level'     => rand(1, 5)
                ];
            }
        }
        DB::table('skill_levels')->insert($data);
    }
}

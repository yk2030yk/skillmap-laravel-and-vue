<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team_names = [
            '中村チーム',
            '宮元チーム',
            '小海チーム',
            '坂林チーム'
        ]; 
        
        $data = [];
        foreach ($team_names as $name) {
            $data[] = ['name' => $name];
        }
        DB::table('teams')->insert($data);
    }
}

<?php

use Illuminate\Database\Seeder;

class CertificationStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = DB::table('members')->get();
        $certifications = DB::table('certifications')->get();
        
        $data = [];
        foreach ($members as $member) {
            foreach ($certifications as $certification) {
                # 資格獲得状況はDBにあるかないかなのでランダムで追加する
                if (rand(1, 100) % 2 == 0) {
                    continue;
                }

                $data[] = [
                    'member_id' => $member->id,
                    'certification_id' => $certification->id,
                ];
            }
        }
        DB::table('certification_statuses')->insert($data);
    }
}

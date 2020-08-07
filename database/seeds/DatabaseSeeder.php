<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SkillLargeCategoriesTableSeeder::class,
            SkillSmallCategoriesTableSeeder::class,
            SkillsTableSeeder::class,

            CertificationCategoriesTableSeeder::class,
            CertificationsTableSeeder::class,
            
            TeamsTableSeeder::class,
            MembersTableSeeder::class,
            
            SkillLevelsTableSeeder::class,
            SkillLevelsFeatureTableSeeder::class,
            CertificationStatusesTableSeeder::class
        ]);
    }
}

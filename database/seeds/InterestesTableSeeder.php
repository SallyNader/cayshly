<?php

use Illuminate\Database\Seeder;

class InterestesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interestes')->insert([
			'intNameEn'=> 'Mobiles',
			'intNameAr'=> 'الموبايلات',
        ]);
    }
}

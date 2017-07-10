<?php

use Illuminate\Database\Seeder;

class HobbiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hobbies')->insert([
			'hobNameEn'=> 'Sports',
			'hobNameAr'=> 'الرياضة',
        ]);
    }
}

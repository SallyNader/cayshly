<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
			'cat_name_en'=> 'MOBILES',
			'cat_name_ar'=> 'موبايلات',
        ]);

        DB::table('categories')->insert([
			'cat_name_en'=> 'Supplements',
			'cat_name_ar'=> 'مكملات',
        ]);

        DB::table('categories')->insert([
			'cat_name_en'=> 'Fans',
			'cat_name_ar'=> 'مراوح',
        ]);

        DB::table('categories')->insert([
			'cat_name_en'=> 'Heaters',
			'cat_name_ar'=> 'دفايات',
        ]);

        DB::table('categories')->insert([
			'cat_name_en'=> 'Computers & Networking',
			'cat_name_ar'=> 'كمبيوتر و شبكات',
        ]);

        DB::table('categories')->insert([
			'cat_name_en'=> 'TABLETS',
			'cat_name_ar'=> 'تابلت',
        ]);

        DB::table('categories')->insert([
			'cat_name_en'=> 'Air Conditions',
			'cat_name_ar'=> 'تكييفات',
        ]);

        DB::table('categories')->insert([
			'cat_name_en'=> 'TVS, GAMING & CAMERAS',
			'cat_name_ar'=> 'تلفيزيونات',
        ]);
    }
}

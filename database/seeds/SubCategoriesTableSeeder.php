<?php

use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
			'cat_id'=> 1,
			'sub_cat_name_en'=> 'iphone',
			'sub_cat_name_ar'=> 'اي فون',
        ]);
        DB::table('subcategories')->insert([
			'cat_id'=> 1,
			'sub_cat_name_en'=> 'Nokia',
			'sub_cat_name_ar'=> 'نوكيا',
        ]);
        DB::table('subcategories')->insert([
			'cat_id'=> 1,
			'sub_cat_name_en'=> 'Samsung',
			'sub_cat_name_ar'=> 'سامسونج',
        ]);

        DB::table('subcategories')->insert([
			'cat_id'=> 2,
			'sub_cat_name_en'=> 'Fitness Supplements',
			'sub_cat_name_ar'=> 'مكملات غذائية رياضية',
        ]);

        DB::table('subcategories')->insert([
			'cat_id'=> 3,
			'sub_cat_name_en'=> 'Grouhy',
			'sub_cat_name_ar'=> 'جروهى',
        ]);
        DB::table('subcategories')->insert([
			'cat_id'=> 3,
			'sub_cat_name_en'=> 'Unionaire',
			'sub_cat_name_ar'=> 'يونيون اير',
        ]);

        DB::table('subcategories')->insert([
			'cat_id'=> 4,
			'sub_cat_name_en'=> 'Heater',
			'sub_cat_name_ar'=> 'سخان',
        ]);

    }
}

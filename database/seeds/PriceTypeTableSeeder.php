<?php

use Illuminate\Database\Seeder;

class PriceTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pricetype')->insert([
			'PTShort'=> 'EGP',
			'PTFull'=> 'Egyptian Pound',
        ]);
        DB::table('pricetype')->insert([
			'PTShort'=> 'USD',
			'PTFull'=> 'U.S. Dollar',
        ]);
        DB::table('pricetype')->insert([
			'PTShort'=> 'AUD',
			'PTFull'=> 'Australian Dollar',
        ]);
        DB::table('pricetype')->insert([
			'PTShort'=> 'EUR',
			'PTFull'=> 'Euro',
        ]);
    }
}

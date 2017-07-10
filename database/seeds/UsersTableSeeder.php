<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
			'name'=> 'Ahmed',
			'lastName'=> 'Samy',
			'email'=> 'ahmed@cayshly.com',
			'password'=> bcrypt('123456'),
			'phone'=> '01234567891',
			'parentEmail'=> 'cayshly@cayshly.com',
			'about'=> str_random(60),
			'gender'=> 'male',
			'dateOfBirth'=> '05/12/86',
			'nationality'=> 'Egyptian',
			'school'=> 'El-Hassan School',
			'university'=> 'Cairo University',
			'jobTitle'=> 'Developer',
			'company'=> 'Daleel Company',
			'education'=> 'Masters',
			'country'=> '1',
			'city'=> '1',
			'area'=> '1',
			'uActive'=> '1',
			'uActiveCode'=> '',
			'facebook'=> 'https://www.facebook.com/',
			'linkedIn'=> 'https://www.linkedin.com/',
			'instagram'=> 'https://www.instagram.com/',
        	]);

    }
}

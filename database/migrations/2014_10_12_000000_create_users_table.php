<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');                     // User Id
            $table->string('name');                       // User Firest Name
            $table->string('lastName');                   // User Last Name
            $table->string('email')->unique();            // User E-mail
            $table->string('password', 60);               // User Password
            $table->integer('phone');                     // User Phone
            $table->string('parentEmail');                // User Parent Email
            $table->string('address')->nullable();        // Address
            $table->text('about');                        // User Bio
            $table->string('gender');                     // User Gender
            $table->string('dateOfBirth');                // User Date of Birth
            $table->string('nationality');                // User Nationality
            $table->string('school');                     // User Nationality
            $table->string('university');                 // User University
            $table->string('jobTitle');                   // User Job Title
            $table->string('company');                    // User Company
            $table->string('education');                  // User Education
            $table->integer('country');                   // User Country
            $table->integer('city');                      // User City
            $table->integer('area');                      // User Area
            $table->string('facebook');                   // User Facebook
            $table->string('linkedIn');                   // User LinkedIn
            $table->string('instagram');                  // User Instagram
            $table->string('uImg');                       // User Profile picture
            $table->string('uCover');                     // User Cover image
            $table->tinyInteger('uActive');               // 1 or 0 to check user activation
            $table->string('uActiveCode');                // activation code
            $table->boolean('uPointActive');              // activate points
            $table->integer('showed_notifications');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

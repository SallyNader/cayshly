<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{

	protected $primaryKey="l_id";
  
  protected $fillable=["user_id","login_date","noOfLogin"];

}

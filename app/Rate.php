<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    protected $fillable=['product_id','star1','star2','star3','star4','star5'];
}

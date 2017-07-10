<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
protected $primaryKey='ProId';


  public function images(){



    return $this->hasMany('App\Images');
  }



public function users(){




  return $this->belongsToMany('App\User','product_user','product_id','user_id');
}
}

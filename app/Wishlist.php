<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{


  protected $primaryKey='w_id';

  protected $fillable=['user_id','product_id'];

  public function user(){



    return $this->belongsTo('App\User');
  }
}

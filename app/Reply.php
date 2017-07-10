<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

  protected $primaryKey="r_id";
protected $table="replys";
protected $fillable=['user_id','comment_id','reply'];



  public function comment(){


  return $this->belongsTo("App\Comment");
  }



  public function user(){


    return $this->belongsTo("App\User");
  }
}

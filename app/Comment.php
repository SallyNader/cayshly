<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   protected $primaryKey="CoId";
protected $fillable=['CoPostId','CoUserId','CoText','CoDate'];
    public function replies(){
    return $this->hasMany("App\Reply");
    }
    public function user(){
      return $this->belongsTo("App\User","CoUserId");
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $primaryKey = 'PoId';

    protected $fillable=["PoUserId","PoProductId","PoProductName","PoAmount","PoItemNums","PoFrom","PoStatus","PoBNumber","PoDate","PoConfirm"];
}

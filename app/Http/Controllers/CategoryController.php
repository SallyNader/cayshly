<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends Controller
{
    // Show all related categories
    public function showRelatedCats($id){

    	$products = DB::table('products')->where('ProCatId','=', $id)->get();

    	return view('category.allcats', ['products'=>$products, 'id'=>$id]);
    }
}

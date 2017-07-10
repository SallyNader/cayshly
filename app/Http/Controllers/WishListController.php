<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
use Mail;
use User;
use App\Wishlist;

class WishListController extends Controller
{



  public function index(){




    $wishlist=DB::table('products')->join('wishlists','wishlists.product_id','=','products.ProId')->

   select('products.*')->where('wishlists.user_id','=',Auth::user()->id)->get();






return view('wishlist.wishlist',compact('wishlist'));


  }





  public function store(Request $request){


    $product_id=$request->get('product_id');

    $user_id=Auth::user()->id;


    Wishlist::create([

'user_id'=>$user_id,
'product_id'=>$product_id

    ]);



return redirect()->back();

}









public function destroy($id){
$wish=Wishlist::where('product_id',$id)->delete();

// $wish->delete();


return redirect()->back();




}





  }



















































?>

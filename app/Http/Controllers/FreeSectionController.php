<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Point;
use Auth;
use DB;
use Mail;
class FreeSectionController extends Controller
{
    /**
     * Get total points
     */


    public function seeAll($flag){



$myPoints=Point::where('PoUserId',Auth::user()->id)->first();
    $myPoints=$myPoints->PoAmount;
    $LE=$myPoints/100;
    $user=Auth::user()->id;
    $LEround=floor($myPoints/100);
    $products=Product::all();

    if($flag == 0){


$products = $proExact=DB::table('products')->
    join('stores','stores.Sid','=','products.ProStoreId')->
    select('products.*')->
    where('products.ProPrice',"<=",$LEround)->where('stores.SIsPlan','=',1)->
    orderBy('products.ProPrice')->get();

    }
     if($flag == 20){


$products= DB::table('products')->join('stores','stores.Sid','=','products.ProStoreId')->

    select('products.*')->
    where('ProPrice',$LEround+20)->where('stores.SIsPlan','=',1)->get();
     }
      if($flag == 50){

        $products=DB::table('products')->join('stores','stores.Sid','=','products.ProStoreId')->

    select('products.*')->
    where('ProPrice',$LEround+50)->where('stores.SIsPlan','=',1)->get();

      }
        if($flag ==100){
          $products =DB::table('products')->join('stores','stores.Sid','=','products.ProStoreId')->

    select('products.*')->
    where('ProPrice',$LEround+100)->where('stores.SIsPlan','=',1)->get();

        }


        return view("free.seeAll",compact("products","flag"));
    }
    public function getTotalPoints(){
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $redeemedPoints = DB::select("select SUM(PoAmount) as red from points where PoUserId = $userId AND PoFrom = 'redeeming' AND PoConfirm = 1");
            $purchasedPoints = DB::select("select SUM(PoAmount) as pur from points where PoUserId = '$userId' AND PoFrom = 'purchasing' AND PoConfirm = 1");
            $totalPoints = $purchasedPoints[0]->pur - $redeemedPoints[0]->red;
        }else{
            $totalPoints = "You Have No Points.";
        }
        return $totalPoints;
    }
    
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {

    if (Auth::check()) {


    $exact[]="";
    $plusOne[]="";
    $plusFive[]="";
    $plusTen[]="";
    $plusTwinty[]="";
    $plusFifty[]="";
    $plusHundred[]="";
    $plusTwoHundred[]="";
    $plusRournd[]="";

    $myPoints=Point::where('PoUserId',Auth::user()->id)->first();
    $myPoints=$myPoints->PoAmount;
    $LE=$myPoints/100;
    $user=Auth::user()->id;
    $LEround=floor($myPoints/100);
    $products=Product::all();

    $proRound=Product::where('ProPrice',">",$LEround+1)->where('ProPrice',"<=",$LEround+200)->orderBy('ProPrice')->get();

    $proRound=DB::table('products')->
    join('stores','stores.Sid','=','products.ProStoreId')->
    select('products.*')->
    where('ProPrice',">",$LEround+1)->where('ProPrice',"<=",$LEround+200)->where('stores.SIsPlan','=',1)->
    orderBy('products.ProPrice')->get();

    // $proExact=Product::where('ProPrice',"<=",$LEround)->orderBy('ProPrice')->get();

    $proExact=DB::table('products')->
    join('stores','stores.Sid','=','products.ProStoreId')->
    select('products.*')->
    where('products.ProPrice',"<=",$LEround)->where('stores.SIsPlan','=',1)->
    orderBy('products.ProPrice')->get();

    // $proOne=Product::where('ProPrice',$LEround+1)->get();

    $proOne=DB::table('products')->join('stores','stores.Sid','=','products.ProStoreId')->

    select('products.*')->
    where('ProPrice',$LEround+1)->where('stores.SIsPlan','=',1)->get();

    $proFive=DB::table('products')->join('stores','stores.Sid','=','products.ProStoreId')->

    select('products.*')->
    where('ProPrice',$LEround+5)->where('stores.SIsPlan','=',1)->get();

    // $proFive=Product::where('ProPrice',$LEround+5)->get();

    $proTen=DB::table('products')->join('stores','stores.Sid','=','products.ProStoreId')->

    select('products.*')->
    where('ProPrice',$LEround+10)->where('stores.SIsPlan','=',1)->get();
    // $proTen=Product::where('ProPrice',$LEround+10)->get();
    // $protwinty=Product::where('ProPrice',$LEround+20)->get();
    // $proFifty=Product::where('ProPrice',$LEround+50)->get();
    // $proHundred=Product::where('ProPrice',$LEround+100)->get();
    // $proTwoHundred=Product::where('ProPrice',$LEround+200)->get();


    $protwinty=DB::table('products')->join('stores','stores.Sid','=','products.ProStoreId')->

    select('products.*')->
    where('ProPrice',$LEround+20)->where('stores.SIsPlan','=',1)->get();

    $proFifty=DB::table('products')->join('stores','stores.Sid','=','products.ProStoreId')->

    select('products.*')->
    where('ProPrice',$LEround+50)->where('stores.SIsPlan','=',1)->get();

    $proHundred=DB::table('products')->join('stores','stores.Sid','=','products.ProStoreId')->

    select('products.*')->
    where('ProPrice',$LEround+100)->where('stores.SIsPlan','=',1)->get();

    $proTwoHundred=DB::table('products')->join('stores','stores.Sid','=','products.ProStoreId')->

    select('products.*')->
    where('ProPrice',$LEround+200)->where('stores.SIsPlan','=',1)->get();


    // foreach ($products as $product) {
    //    if($product->ProPrice > ($LEround+1) && $product->ProPrice < ($LEround+200 ) ){

    // $plusRournd[]=$product;

    //  }if($product->ProPrice ==$LEround ){

    // $exact[]=$product;
    //  }if($product->ProPrice == ($LEround+1)){

    // $plusOne[]=$product;
    //  } if($product->ProPrice ==($LEround+5) ){

    // $plusFive[]=$product;
    //  }if($product->ProPrice ==($LEround+5) ){

    // $plusFive[]=$product;
    //  } if($product->ProPrice ==($LEround+10) ){

    // $plusTen[]=$product;
    //  } if($product->ProPrice ==($LEround+20) ){

    // $plusTwinty[]=$product;
    //  }if($product->ProPrice ==($LEround+50) ){

    // $plusFifty[]=$product;
    //  } if($product->ProPrice ==($LEround+100) ){

    // $plusHundred[]=$product;
    //  } if($product->ProPrice ==($LEround+200) ){

    // $plusTwoHundred[]=$product;
    //  }
    // }






    //  foreach ($proRound as $product) {

    //      echo $product->ProPrice."<br/>";
    // }





    // $LEone=$LEround+1;
    // $LEfive=$LEround+5;

    // $LEten=$LEround+10;
    // $LEtwinty=$LEround+20;
    // $LEfifty=$LEround+50;
    // $LEhundred=$LEround+100;
    // $LEtwohundred=$LEround+200;



    $categories = DB::table('categories')->get();
    $subcategories = DB::table('subcategories')->get();
    $total = $this->getTotalPoints();
    return view('free.freeSection',compact('LEround','products','proRound','proExact','proOne','proFive','proTen','protwinty','proFifty','proHundred','proTwoHundred','myPoints','categories','subcategories','total'));


    // dd($proExact);

  }else{
    return view('free.freeSection');
  }





  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function inviteHotmail($email){







    $data = ['email' => $email];



    $messageUser = view('template.mail', $data);

    $headersUser = "From: Cayshly<". config('maildata.from') ."> \r\n";
    // $headersUser .= "BCC: ". config('maildata.bcc') ."\r\n";
    $headersUser .= "MIME-Version: 1.0\r\n";
    $headersUser .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($email, 'join cayshly', $messageUser,$headersUser);




    return redirect('contact/import/hotmail')->with('message','done inviting '.$email);



  }


  public function inviteGmail($email){










    $data = ['email' => $email];



    $messageUser = view('template.mail', $data);

    $headersUser = "From: Cayshly<". config('maildata.from') ."> \r\n";
    // $headersUser .= "BCC: ". config('maildata.bcc') ."\r\n";
    $headersUser .= "MIME-Version: 1.0\r\n";
    $headersUser .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($email, 'join cayshly', $messageUser,$headersUser);




    return redirect('contact/import/google')->with('message','done inviting '.$email);

    // Mail::send('template.mail', ['email'=>$email], function ($message) use ($email) {
    //          $message->from("info@cayshly.com", "Cayshly Trading Network");

    //           $message->to($email)->subject('invitation');
    //       });
  }
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}

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

class CartController extends Controller
{

  /**
  * Display the Products In the Cart.
  */
  public function showAllProductsToCart(){
    $products = [];
    if (!empty(session()->get('carts'))) {
      foreach (session()->get('carts') as $key => $value) {
        $products[] =  DB::table('products')->where('ProId','=',$value)->first();
      }
    }
    return view('cart.show', ['products'=>$products]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function addProductToCart(Request $request, $id){
    if (!empty(session()->get('carts'))) {
      if (!in_array($id, session()->get('carts'))) {
        session()->push('carts', $id);
      }
    }else{
      session()->push('carts', $id);
    }
    return redirect('cart');
  }

  /**
  * Delete product from cart
  */
  public function deleteProductFromCart($id){
    $key = array_search($id, session()->get('carts'));
    Session::forget('carts.' . $key);
    return redirect()->back();
  }

  /**
  * Get total points
  */
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
  * Get total points (Redeem Not Confirmed)
  */
  public function getTotalPointsNotConfirmed(){
    if (Auth::check()) {
      $userId = Auth::user()->id;
      $redeemedPoints = DB::select("select SUM(PoAmount) as red from points where PoUserId = $userId AND PoFrom = 'redeeming'");
      $purchasedPoints = DB::select("select SUM(PoAmount) as pur from points where PoUserId = '$userId' AND PoFrom = 'purchasing' AND PoConfirm = 1");
      $totalPoints = $purchasedPoints[0]->pur - $redeemedPoints[0]->red;
    }else{
      $totalPoints = "You Have No Points.";
    }
    return $totalPoints;
  }

  /**
  * Buy the product
  */
  public function buy(Request $request){
    $products = [];
    $index = 0;
    if (!empty(session()->get('carts'))) {
      foreach (session()->get('carts') as $key => $value) {
      	$res = DB::select("SELECT * FROM products JOIN stores ON ProStoreId = Sid WHERE ProId = $value");
      	if(!empty($res)){
      		$products[$index]['product'] = $res[0];
	        $products[$index]['quant'] = $request->input('quant')[$index];
      	}
        $index++;
      }
    }

    $totalAmount = 0;
    foreach ($products as $key => $value) {
      $totalAmount += (int) $products[$key]['quant'] * (int) $products[$key]['product']->ProPrice ;
    }
    return view('actions.buy', ['products'=>$products, 'totalpoints'=> $this->getTotalPoints(), 'totalpointsnotconfirmed'=> $this->getTotalPointsNotConfirmed(), 'totalAmount'=>$totalAmount]);
  }

  /**
  *  Perform User Parents Points
  */
  public function parentsPoints($userId, $products, $quants, $PoFrom, $PoStatus, $numberOfParents){
    if ($userId > 0) {
      for ($i=0; $i < count($products) ; $i++) {
        DB::table('points')->insert([
          'PoUserId'=>$userId,
          'PoProductId'=>'',
          'PoProductName'=>'',
          'PoAmount'=>(((int) $quants[$i] * (int) DB::table('products')->where('ProId','=', $products[$i])->first()->ProPoints * .25 * .5) / (int) $numberOfParents),
          'PoItemNums'=>0,
          'PoFrom'=>$PoFrom,
          'PoStatus'=>$PoStatus
        ]);
      }
      $this->parentsPoints(DB::table('users')->where('id','=', $userId)->first()->parentEmail, $products, $quants, $PoFrom, $PoStatus, $numberOfParents);
    }
  }

  /**
  * Buy the product - Done
  */
  public function buyDone(Request $r){ // PoConfirm
    // Prepare Vars
    $user = Auth::user()->id;
    $name = $r->input('name');
    $phone = $r->input('phone');
    $payment = (in_array($r->input('payment'),['cash','all','custom']))? $r->input('payment') : 'cash' ;
    $redeem_amount = ($r->input('redeem_amount') > $this->getTotalPoints() || $r->input('redeem_amount') < 1)?  $this->getTotalPoints() : $r->input('redeem_amount') ;
    $address = $r->input('address');
    $products = $r->input('product');
    $quants = $r->input('quant');

    $PoFrom = ($payment === 'cash') ? 'purchasing' : 'redeeming' ;
    $PoStatus = ($payment === 'cash') ? 'increased' : 'decreased' ;
    $x = ($payment == 'cash') ? .75 : 1 ;

    // Update the user address
    if ($r->has('address')) {DB::update("update users set address = '$address' where id = ?", [Auth::user()->id]);}

    //Check if the number of points not enough
    $numOfPointsRequired = 0;
    foreach ($products as $key => $value) {
      $numOfPointsRequired += (int) $quants[$key] * (int) DB::table('products')->where('ProId','=', $value)->first()->ProPrice * 100;
    }
    $numOfPointsActual = $this->getTotalPoints();

    // Buy products with redeeming
    if ($PoFrom == 'redeeming') {
      if ($numOfPointsRequired > $numOfPointsActual) {
        session()->flash('msg', '<i class="fa fa-close"></i> Sorry, the number of points not enough!');
        session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
        return redirect('cart');
        exit();
      }
    }

    // Buy Process
    $order_number = Auth::user()->id . time();
    for ($i=0; $i < count($products) ; $i++) {
      DB::table('buys')->insert([
        'BUserId'=>$user,
        'BProId'=>$products[$i],
        'BProQuant'=>$quants[$i],
        'BAddress'=>$address,
        'BStatus'=>1,
        'BNumber'=>$order_number,
        'BReviewd'=>0
      ]);
    }

    // Points Adjustments (For Current User)
    for ($i=0; $i < count($products) ; $i++) {
      if ($PoFrom == 'redeeming'){
        // Multiplay product price * 100 (Point = 1 قرش)
        $PoAmount = (int) $quants[$i] * (float) $x * (float) DB::table('products')->where('ProId','=', $products[$i])->first()->ProPrice * 100;
      }else {
        $PoAmount = (int) $quants[$i] * (float) $x * (float) DB::table('products')->where('ProId','=', $products[$i])->first()->ProPoints;
      }
      DB::table('points')->insert([
        'PoUserId'=>$user,
        'PoProductId'=>$products[$i],
        'PoProductName'=>DB::table('products')->where('ProId','=', $products[$i])->first()->ProName,
        'PoAmount'=>$PoAmount,
        'PoItemNums'=>$quants[$i],
        'PoFrom'=>$PoFrom,
        'PoStatus'=>$PoStatus,
        'PoBNumber'=>$order_number,
      ]);
    }


    // inform user with the
    for ($i=0; $i < count($products) ; $i++) {
      $store = DB::table('products')->where('ProId','=', $products[$i])->first()->ProStoreId;
      DB::table('alerts')->insert([
        'alert_from'     => Auth::user()->id,
        'alert_to'       => DB::table('stores')->where('Sid','=', $store)->first()->SUserId,
        'aler_type'      => 'new_product_from_store',
        'alert_issue_id' => $products[$i],
      ]);
    }

    // Points for first parent (If the order was purchasing)
    if ($PoFrom == 'purchasing') {
      if (DB::table('users')->where('id','=', Auth::user()->id)->first()->parentEmail > 0) {
        for ($i=0; $i < count($products) ; $i++) {
          DB::table('points')->insert([
            'PoUserId'=>DB::table('users')->where('id','=', Auth::user()->id)->first()->parentEmail,
            'PoProductId'=>'',
            'PoProductName'=>'',
            'PoAmount'=>((int) $quants[$i] * (int) DB::table('products')->where('ProId','=', $products[$i])->first()->ProPoints * .25 * .5),
            'PoItemNums'=>0,
            'PoFrom'=>$PoFrom,
            'PoStatus'=>$PoStatus,
            'PoBNumber'=>$order_number,
          ]);
        }
      }
    }

    // Points for other parents (If the order was purchasing)
    if ($PoFrom == 'purchasing') {
      function getUserMembers($userId, $allMembers = [])
      {
        $members = DB::table('users')->where('parentEmail', '=', $userId)->get();
        foreach ($members as $member) {
          $allMembers[] = $member;
          getUserMembers($member->id);
        }
        return $allMembers;
      }

      $allMembers = (int) getUserMembers(Auth::user()->id) - 1;
      $numberOfParents = count($allMembers);

      // Get Parent Of The Parent  $numberOfParents
      $userParent = DB::table('users')->where('id','=', Auth::user()->id)->first();
      if ($userParent->parentEmail != 0) {
        $parentOfTheParent = DB::table('users')->where('id','=', $userParent->parentEmail)->first()->parentEmail;
        // Perform the process
        $this->parentsPoints($parentOfTheParent, $products, $quants, $PoFrom, $PoStatus, $numberOfParents);
      }


    }

    // Emails
    // Send email for the user
    $dataUser = ['name'=>Auth::user()->name];
    $username = Auth::user()->name;
    $usermail = Auth::user()->email;

    // Mail::send('emails.order-confirmation-buyer', $dataUser, function ($message) use ($usermail, $username){
    //     $message->from('no-replay@cayshly.com', 'Cayshly');
    //     $message->to($usermail, $username);
    //     $message->cc('ahmsam39@gmail.com', 'Cayshly');
    //     $message->subject('Your order confirmed | Cayshly');
    // });

    $subject = $username . ' Your order confirmed | Cayshly';
    $message = view('emails.order-confirmation-buyer', $dataUser);

    $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
    $headers .= "BCC: ". config('maildata.bcc') ."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    mail($usermail, $subject, $message, $headers);

    // Send email for store owner
    foreach ($products as $key => $value) {
      $productStoreId = DB::table('products')->where('ProId','=', $value)->first();
      $productStore = DB::table('stores')->where('Sid','=', $productStoreId->ProStoreId)->first();
      $productUser = DB::table('users')->where('id','=', $productStore->SUserId)->first();

      $un = $productUser->name;
      $ue = $productUser->email;
      $dataSeller = ['name'=>$un, 'store'=>$productStore->SName ];

      // Mail::send('emails.order-confirmation-seller', $dataSeller, function ($message) use ($ue, $un){
      //     $message->from('no-replay@cayshly.com', 'Cayshly');
      //     $message->to($ue, $un);
      //     $message->cc('ahmsam39@gmail.com', 'Cayshly');
      //     $message->subject('New Order from your store on Cayshly');
      // });

      $subject2 = $un . ' New Order from your store on Cayshly';
      $message2 = view('emails.order-confirmation-seller', $dataSeller);

      $headers2 = "From: Cayshly<". config('maildata.from') ."> \r\n";
      $headers2 .= "BCC: ". config('maildata.bcc') ."\r\n";
      $headers2 .= "MIME-Version: 1.0\r\n";
      $headers2 .= "Content-Type: text/html; charset=UTF-8\r\n";

      mail($ue, $subject2, $message2, $headers2);
    }

    // Ending
    Session::forget('carts');
    session()->flash('msg', '<i class="fa fa-check"></i> Order Confirmed Successfully, your points under process');
    session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');
    return redirect('points');
  }

  /**
  * Buy with AAIB
  */
  public function buyAAIB(Request $r)
  {
    // Prepare Vars
    $user = Auth::user()->id;
    $name = $r->input('name');
    $phone = $r->input('phone');
    $address = $r->input('address');
    $payment = 'aaib';
    $productitems = $r->input('product');
    $quants = $r->input('quant');

    // Buy Process
    $order_number = Auth::user()->id . time();
    for ($i=0; $i < count($productitems) ; $i++) {
      DB::table('buys')->insert([
        'BUserId'=>$user,
        'BProId'=>$productitems[$i],
        'BProQuant'=>$quants[$i],
        'BAddress'=>$address,
        'BType'=>$payment,
        'BStatus'=>1,
        'BNumber'=>$order_number,
        'BReviewd'=>0
      ]);
    }

    $products = [];
    $index = 0;
    if (!empty(session()->get('carts'))) {
      foreach (session()->get('carts') as $key => $value) {
        $products[$index]['product'] = DB::select("SELECT * FROM products JOIN stores ON ProStoreId = Sid WHERE ProId = $value")[0];
        $products[$index]['quant'] = $r->input('quant')[$index];
        $index++;
      }
    }

    $totalAmount = 0;
    foreach ($products as $key => $value) {
      $totalAmount += (int) $products[$key]['quant'] * (int) $products[$key]['product']->ProPrice ;
    }

    $vpc_MerchTxnRef  = $order_number + Auth::user()->id;      // The site ref
    $vpc_OrderInfo    = $order_number;                         // The order info or order number
    $vpc_Amount       = $totalAmount;                          // The order amount

    // Send Rando String To the user
    $dataUser = ['name'=>Auth::user()->name, 'vpc_OrderInfo'=>$vpc_OrderInfo];
    $username = Auth::user()->name;
    $usermail = Auth::user()->email;
    $subject = 'Your order Info | Cayshly';
    $message = view('emails.order-random-string', $dataUser);
    $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
    $headers .= "BCC: ". config('maildata.bcc') ."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($usermail, $subject, $message, $headers);


    return view('actions.buyAAIB', [
      'products'=>$products,
      'totalpoints'=> $this->getTotalPoints(),
      'vpc_MerchTxnRef'=>$vpc_MerchTxnRef,
      'vpc_OrderInfo'=>$vpc_OrderInfo,
      'vpc_Amount'=>$vpc_Amount,
    ]);

  }

  /**
  * Buy AAIB Do The Transaction
  */
  public function buyAAIBDo(Request $r)
  {
    $POST = [];
    $POST["Title"]                    = $r->get('Title');
    $POST["virtualPaymentClientURL"]  = $r->get('virtualPaymentClientURL');
    $POST["vpc_Version"]              = $r->get('vpc_Version');
    $POST["vpc_Command"]              = $r->get('vpc_Command');
    $POST["vpc_AccessCode"]           = $r->get('vpc_AccessCode');
    $POST["vpc_MerchTxnRef"]          = $r->get('vpc_MerchTxnRef');
    $POST["vpc_Merchant"]             = $r->get('vpc_Merchant');
    $POST["vpc_OrderInfo"]            = $r->get('vpc_OrderInfo');
    $POST["vpc_Amount"]               = $r->get('vpc_Amount');
    $POST["vpc_ReturnURL"]            = $r->get('vpc_ReturnURL');
    $POST["vpc_Locale"]               = $r->get('vpc_Locale');
    $POST["vpc_Currency"]             = $r->get('vpc_Currency');

    return view('aaib.PHP_VPC_3Party_Order_DO', compact('POST'));
  }


  /**
  * Buy AAIB Confirmation
  */
  public function buyAAIBConfirmation(Request $r)
  {
    $POST = [];
    $POST["Title"]                    = $r->get('Title');
    $POST["virtualPaymentClientURL"]  = $r->get('virtualPaymentClientURL');
    $POST["vpc_Version"]              = $r->get('vpc_Version');
    $POST["vpc_Command"]              = $r->get('vpc_Command');
    $POST["vpc_AccessCode"]           = $r->get('vpc_AccessCode');
    $POST["vpc_MerchTxnRef"]          = $r->get('vpc_MerchTxnRef');
    $POST["vpc_Merchant"]             = $r->get('vpc_Merchant');
    $POST["vpc_OrderInfo"]            = $r->get('vpc_OrderInfo');
    $POST["vpc_Amount"]               = $r->get('vpc_Amount');
    $POST["vpc_ReturnURL"]            = $r->get('vpc_ReturnURL');
    $POST["vpc_Locale"]               = $r->get('vpc_Locale');
    $POST["vpc_Currency"]             = $r->get('vpc_Currency');

    // Get the order from buys table
    $order = DB::table('buys')->where('BNumber', $POST["vpc_OrderInfo"])->get();
    //dd($order);

    //return view('emails.order-confirmation-details', ['name'=>Auth::user()->name, 'orders'=>$order]);

    // // Points Adjustments (For Current User)
    // for ($i=0; $i < count($products) ; $i++) {
    //   $PoAmount = (int) $quants[$i] * (float) $x * (float) DB::table('products')->where('ProId','=', $products[$i])->first()->ProPoints;
    //   DB::table('points')->insert([
    //     'PoUserId'=>$user,
    //     'PoProductId'=>$products[$i],
    //     'PoProductName'=>DB::table('products')->where('ProId','=', $products[$i])->first()->ProName,
    //     'PoAmount'=>$PoAmount,
    //     'PoItemNums'=>$quants[$i],
    //     'PoFrom'=>$PoFrom,
    //     'PoStatus'=>$PoStatus,
    //     'PoBNumber'=>$order_number,
    //   ]);
    // }
    //
    //
    // // inform user with the
    // for ($i=0; $i < count($products) ; $i++) {
    //   $store = DB::table('products')->where('ProId','=', $products[$i])->first()->ProStoreId;
    //   DB::table('alerts')->insert([
    //     'alert_from'     => Auth::user()->id,
    //     'alert_to'       => DB::table('stores')->where('Sid','=', $store)->first()->SUserId,
    //     'aler_type'      => 'new_product_from_store',
    //     'alert_issue_id' => $products[$i],
    //   ]);
    // }
    //
    // // Points for first parent (If the order was purchasing)
    // if ($PoFrom == 'purchasing') {
    //   if (DB::table('users')->where('id','=', Auth::user()->id)->first()->parentEmail > 0) {
    //     for ($i=0; $i < count($products) ; $i++) {
    //       DB::table('points')->insert([
    //         'PoUserId'=>DB::table('users')->where('id','=', Auth::user()->id)->first()->parentEmail,
    //         'PoProductId'=>'',
    //         'PoProductName'=>'',
    //         'PoAmount'=>((int) $quants[$i] * (int) DB::table('products')->where('ProId','=', $products[$i])->first()->ProPoints * .25 * .5),
    //         'PoItemNums'=>0,
    //         'PoFrom'=>$PoFrom,
    //         'PoStatus'=>$PoStatus,
    //         'PoBNumber'=>$order_number,
    //       ]);
    //     }
    //   }
    // }
    //
    // // Points for other parents (If the order was purchasing)
    // if ($PoFrom == 'purchasing') {
    //   function getUserMembers($userId, $allMembers = [])
    //   {
    //     $members = DB::table('users')->where('parentEmail', '=', $userId)->get();
    //     foreach ($members as $member) {
    //       $allMembers[] = $member;
    //       getUserMembers($member->id);
    //     }
    //     return $allMembers;
    //   }
    //
    //   $allMembers = (int) getUserMembers(Auth::user()->id) - 1;
    //   $numberOfParents = count($allMembers);
    //
    //   // Get Parent Of The Parent  $numberOfParents
    //   $userParent = DB::table('users')->where('id','=', Auth::user()->id)->first();
    //   if ($userParent->parentEmail != 0) {
    //     $parentOfTheParent = DB::table('users')->where('id','=', $userParent->parentEmail)->first()->parentEmail;
    //     // Perform the process
    //     $this->parentsPoints($parentOfTheParent, $products, $quants, $PoFrom, $PoStatus, $numberOfParents);
    //   }
    //
    // }
    //

    // Emails
    // Send email for the user
    $dataUser = ['name'=>Auth::user()->name, 'orders'=>$order];
    $username = Auth::user()->name;
    $usermail = Auth::user()->email;
    $subject = $username . ' Your order confirmed | Cayshly';
    $message = view('emails.order-confirmation-details', $dataUser);
    $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
    $headers .= "BCC: ". config('maildata.bcc') ."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail($usermail, $subject, $message, $headers);


    // // Send email for store owner
    // foreach ($products as $key => $value) {
    //   $productStoreId = DB::table('products')->where('ProId','=', $value)->first();
    //   $productStore = DB::table('stores')->where('Sid','=', $productStoreId->ProStoreId)->first();
    //   $productUser = DB::table('users')->where('id','=', $productStore->SUserId)->first();
    //
    //   $un = $productUser->name;
    //   $ue = $productUser->email;
    //   $dataSeller = ['name'=>$un, 'store'=>$productStore->SName];
    //
    //   $subject2 = $un . ' New Order from your store on Cayshly';
    //   $message2 = view('emails.order-confirmation-seller', $dataSeller);
    //
    //   $headers2 = "From: Cayshly<". config('maildata.from') ."> \r\n";
    //   $headers2 .= "BCC: ". config('maildata.bcc') ."\r\n";
    //   $headers2 .= "MIME-Version: 1.0\r\n";
    //   $headers2 .= "Content-Type: text/html; charset=UTF-8\r\n";
    //
    //   // mail($ue, $subject2, $message2, $headers2);
    // }

    // Ending
    Session::forget('carts');

    return view('actions.buyConfirmed');
    //return view('aaib.PHP_VPC_3Party_Order_DR');
  }

}

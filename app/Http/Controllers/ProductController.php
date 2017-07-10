<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Product;
use App\Wishlist;
use App\User;
use App\Image;
use App\Rate;
class ProductController extends Controller
{

//start of new updates

public function rateProduct(Request $request){


          $addOne=1;
          $star=$request->get('star');

          $product_id=$request->get('product_id');

          // $user=User::find(Auth::user()->id);
          // $user->is_rate=1;
          // $user->save();


    $p=Rate::where('product_id',$product_id)->first();

    if(is_null($p)){


     if($star == 1)


     Rate::create([

'product_id'=>$product_id,
'star1'=>1

     ]);


     if($star == 2)


     Rate::create([

'product_id'=>$product_id,
'star2'=>1

     ]);
     if($star == 3)

     Rate::create([

'product_id'=>$product_id,
'star3'=>1

     ]);
     if($star == 4)

     Rate::create([

'product_id'=>$product_id,
'star4'=>1

     ]);
     if($star == 5)

     Rate::create([

'product_id'=>$product_id,
'star5'=>1

     ]);









    }else {




$rate=Rate::where('product_id',$product_id)->first();

 if($star == 1)

 $rate->star1=$rate->star1+$addOne;

  if($star == 2)

  $rate->star2 = $rate->star2 + $addOne;
   if($star == 3)


   $rate->star3=$rate->star3+$addOne;
    if($star == 4)

    $rate->star4=$rate->star4+$addOne;
     if($star == 5)

     $rate->star5=$rate->star5+$addOne;


$rate->save();

    }








// DB::table('product_user')->insert([
//
//
//
//
//   'product_id'=>$product_id,'user_id'=>Auth::user()->id
// ]);
//           $product=Product::find($product_id);
//
//           $product->rating =$product->rating +$plus;
//           $product->save();
//

//
          return redirect()->back();










}




public function like(Request $request){
$product_id=$request->get("id");
$user_id=Auth::user()->id;
$like=DB::table('like_product')->insert(


  [
    "product_id"=>$product_id,
    "user_id"=>$user_id
  ]
);
return redirect()->back();

}
public function unlike(Request $request){
$product_id=$request->get("id");
$like=DB::table("like_product")->where("product_id",$product_id)->where("user_id",Auth::user()->id)->delete();



return redirect()->back();

}

    public function deleteTest($id,Request $request){


                     $product=Product::find($id);


                     if($request->ajax()){



                       $product->delete( $request->all() );
                       return response(['msg' => 'Product deleted', 'status' => 'success']);
      }
      return response(['msg' => 'Failed deleting the product', 'status' => 'failed']);



              }
//end of updates
    public function getPointsScheme($price){
        switch ($price) {
            case $price >= 0 && $price <= 20 :
                $points = $price * (.15 * 100);
                break;

            case $price >= 21 && $price <= 60 :
                $points = $price * (.13 * 100);
                break;

            case $price >= 61 && $price <= 150 :
                $points = $price * (.10 * 100);
                break;

            case $price >= 151 && $price <= 400 :
                $points = $price * (.08 * 100);
                break;

            case $price >= 401 && $price <= 800 :
                $points = $price * (.06 * 100);
                break;

            case $price >= 801 && $price <= 2000 :
                $points = $price * (.04 * 100);
                break;
                
            case $price >= 2001 && $price <= 10000 :
                $points = $price * (.03 * 100);
                break;

            case $price >= 10001 && $price <= 100000 :
                $points = $price * (.02 * 100);
                break;

            case $price >= 100001 :
                $points = $price * (.01 * 100);
                break;
        }

        return $points;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $storesToCheck = [195, 296, 304];
        if (in_array($request->input('store'), $storesToCheck)) {
            
            $subCatId = (int) $request->input('pro_subcat');
            $catId = DB::table('subcategories')->where('id', '=', $subCatId)->first();

            if($catId->cat_id != 0){

                $product = new Product();

                $product->ProCatId = $catId->cat_id;
                
                if ($request->has('store')) {$product->ProStoreId = $request->input('store');}
                if ($request->has('pro_subcat')) {$product->ProSubCatId = $subCatId;}
                if ($request->has('pro_price')) { $product->ProPrice = $request->input('pro_price');}
                if ($request->has('pro_name')) {$product->ProName = $request->input('pro_name');}
                if ($request->has('pro_pricetype')) {$product->ProPriceType = $request->input('pro_pricetype');}
                if ($request->has('pro_condition')) {$product->ProCondition = $request->input('pro_condition');}
                if ($request->has('pro_warranty')) {$product->ProWarranty = $request->input('pro_warranty');}
                if ($request->has('pro_description')) {$product->ProDescription = $request->input('pro_description');}
                if ($request->has('pro_vidurl')) { $product->ProVideo = $request->input('pro_vidurl');}

                // Points
                if ($request->has('storeStatus')) {
                    if ($request->input('storeStatus') == 0) {
                        $product->ProPoints = 0;
                    }else{
                        $product->ProPoints = $this->getPointsScheme($request->input('pro_price'));
                    }
                }
                // Upload image
                $file = $request->file('pro_image');
                if ($request->hasFile('pro_image')) {
                    $ext = strtolower($file->getClientOriginalExtension());
                    $validExt = ['jpg','gif','jpeg','png'];

                    if (in_array($ext, $validExt)) {
                        // the file is image
                        $filename = time().rand(1000,9999).'.'.$ext;
                        $upload = $file->move(base_path().'/assets/images/products', $filename);

                        if ($upload) {
                            $quality = config('vars.imageQuality');
                            $image = base_path().'/assets/images/products/' . $filename;
                            $info = getimagesize($image);

                            if ($info['mime'] == 'image/jpeg'){
                                $soueceimage = imagecreatefromjpeg($image);
                                header("Content-Type: image/jpeg");
                                imagejpeg($soueceimage, base_path().'/assets/images/products/' . $filename, $quality);
                            } 
                            elseif ($info['mime'] == 'image/gif') {
                                $soueceimage = imagecreatefromgif($image);
                                header('Content-Type: image/gif');
                                imagegif($soueceimage, base_path().'/assets/images/products/' . $filename, $quality);
                            }
                            elseif ($info['mime'] == 'image/png') {
                                $soueceimage = imagecreatefrompng($image);
                                header("Content-Type: image/png");
                                imagepng($soueceimage, base_path().'/assets/images/products/' . $filename);
                            }

                            $product->ProDefaultImg = $filename;
                        }

                        session()->flash('msg', '<i class="fa fa-check"></i> Added Successfully');
                        session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');

                    }else{
                        // the file is not image
                        session()->flash('msg', '<i class="fa fa-close"></i> The file is not an image');
                        session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
                        return redirect()->back();
                    }

                }else{
                    // file not exist
                    session()->flash('msg', '<i class="fa fa-close"></i> Please select image');
                    session()->flash('dis', 'style="display:block;background-color:#7f0600;"');

                    return redirect()->back();
                }

                $product->save();

                // Notification track
                $productId = DB::table('products')->where('ProStoreId','=',$request->input('store'))->orderBy('ProId', 'desc')->first();
                DB::table('notifs')->insert([
                    'NotifUserId'     => Auth::user()->id,
                    'NotifActionId'   => $productId->ProId,
                    'NotifActionType' => 'product'
                ]);


                return redirect()->back();
            }else{
                // no cat found
                session()->flash('msg', '<i class="fa fa-close"></i> Please select valid sub category');
                session()->flash('dis', 'style="display:block;background-color:#7f0600;"');

                return redirect()->back();
            }
        }
        
        elseif ($request->input('pro_price') != '' && $request->input('pro_price') != '0') {
            $subCatId = (int) $request->input('pro_subcat');
            $catId = DB::table('subcategories')->where('id', '=', $subCatId)->first();

            if($catId->cat_id != 0){

                $product = new Product();

                $product->ProCatId = $catId->cat_id;
                
                if ($request->has('store')) {$product->ProStoreId = $request->input('store');}
                if ($request->has('pro_subcat')) {$product->ProSubCatId = $subCatId;}
                if ($request->has('pro_price')) { $product->ProPrice = $request->input('pro_price');}
                if ($request->has('pro_name')) {$product->ProName = $request->input('pro_name');}
                if ($request->has('pro_pricetype')) {$product->ProPriceType = $request->input('pro_pricetype');}
                if ($request->has('pro_condition')) {$product->ProCondition = $request->input('pro_condition');}
                if ($request->has('pro_warranty')) {$product->ProWarranty = $request->input('pro_warranty');}
                if ($request->has('pro_description')) {$product->ProDescription = $request->input('pro_description');}
                if ($request->has('pro_vidurl')) { $product->ProVideo = $request->input('pro_vidurl');}

                // Points
                if ($request->has('storeStatus')) {
                    if ($request->input('storeStatus') == 0) {
                        $product->ProPoints = 0;
                    }else{
                        $product->ProPoints = $this->getPointsScheme($request->input('pro_price'));
                    }
                }
                // Upload image
                $file = $request->file('pro_image');
                if ($request->hasFile('pro_image')) {
                    $ext = strtolower($file->getClientOriginalExtension());
                    $validExt = ['jpg','gif','jpeg','png'];

                    if (in_array($ext, $validExt)) {
                        // the file is image
                        $filename = time().rand(1000,9999).'.'.$ext;
                        $upload = $file->move(base_path().'/assets/images/products', $filename);

                        if ($upload) {
                            $quality = config('vars.imageQuality');
                            $image = base_path().'/assets/images/products/' . $filename;
                            $info = getimagesize($image);

                            if ($info['mime'] == 'image/jpeg'){
                                $soueceimage = imagecreatefromjpeg($image);
                                header("Content-Type: image/jpeg");
                                imagejpeg($soueceimage, base_path().'/assets/images/products/' . $filename, $quality);
                            } 
                            elseif ($info['mime'] == 'image/gif') {
                                $soueceimage = imagecreatefromgif($image);
                                header('Content-Type: image/gif');
                                imagegif($soueceimage, base_path().'/assets/images/products/' . $filename, $quality);
                            }
                            elseif ($info['mime'] == 'image/png') {
                                $soueceimage = imagecreatefrompng($image);
                                header("Content-Type: image/png");
                                imagepng($soueceimage, base_path().'/assets/images/products/' . $filename);
                            }

                            $product->ProDefaultImg = $filename;
                        }

                        session()->flash('msg', '<i class="fa fa-check"></i> Added Successfully');
                        session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');

                    }else{
                        // the file is not image
                        session()->flash('msg', '<i class="fa fa-close"></i> The file is not an image');
                        session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
                        return redirect()->back();
                    }

                }else{
                    // file not exist
                    session()->flash('msg', '<i class="fa fa-close"></i> Please select image');
                    session()->flash('dis', 'style="display:block;background-color:#7f0600;"');

                    return redirect()->back();
                }

                $product->save();

                 // Notification track
                $productId = DB::table('products')->where('ProStoreId','=',$request->input('store'))->orderBy('ProId', 'desc')->first();
                DB::table('notifs')->insert([
                    'NotifUserId'     => Auth::user()->id,
                    'NotifActionId'   => $productId->ProId,
                    'NotifActionType' => 'product'
                ]);

                return redirect()->back();
            }else{
                // no cat found
                session()->flash('msg', '<i class="fa fa-close"></i> Please select valid sub category');
                session()->flash('dis', 'style="display:block;background-color:#7f0600;"');

                return redirect()->back();
            }
        }

        else{
            // No Price
            session()->flash('msg', '<i class="fa fa-close"></i> Price can not be empty');
            session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


      
// $isRate=User::find(Auth::user()->id);
//if user like Product
if(! empty(Auth::user()->id)){
$ifLike=DB::table('like_product')->where('product_id',$id)->where("user_id",Auth::user()->id)->get();
}else{
$ifLike=null;
}
$numberOfLikes=DB::table('like_product')->where('product_id',$id)->count();
 $rating=Rate::where('product_id',$id)->first();
 if(!is_null( $rating))
{
  $one=$rating->star1;
$two=$rating->star2;
$three=$rating->star3;
$four=$rating->star4;
$five=$rating->star5;
 $array=['star1'=>$one,'star2'=>$two,'star3'=>$three,'star4'=>$four,'star5'=>$five];
 $max=array_keys($array,max($array));
}
$wishlist=Wishlist::where('product_id',$id)->get();
      $images=Image::where('product_id',$id)->get();
        $product = DB::select("SELECT * FROM products JOIN stores ON ProStoreId = Sid JOIN categories ON ProCatId = id WHERE ProId = $id LIMIT 1");
        if (count($product) != 0) {
            $productComments = DB::select("SELECT * FROM productcomments JOIN users ON ProComUserId = id WHERE ProComProId = $id");
            $relatedProductsCat = $product[0]->ProCatId;
            $relatedProducts = DB::select("SELECT * FROM products WHERE ProCatId = $relatedProductsCat AND ProId <> $id");
                if(!is_null( $rating) ){
                        return view('products.show',[
                            'product'=>$product[0],
                            'relatedProducts'=>$relatedProducts,
                            'productComments'=>$productComments,
                            'images'=>  $images,
                            'wishlist'=>$wishlist,
                            'ifLike'=>$ifLike,
                            // 'isRate'=>$isRate,
                           'max'=>$max[0],
                           'numberOfLikes'=>$numberOfLikes
                        ]);
}
            return view('products.show',[
                'product'=>$product[0],
                'relatedProducts'=>$relatedProducts,
                'productComments'=>$productComments,
                'images'=>  $images,
                'wishlist'=>$wishlist,
                    'ifLike'=>$ifLike,
                  'numberOfLikes'=>$numberOfLikes
                // 'isRate'=>$isRate,
            ]);
        }else{
            return redirect('/');
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProduct($id)
    {
        $userId = Auth::user()->id;

        $images=Image::where('product_id',$id)->get();
        $product = DB::table('products')->where('ProId','=',$id)->first();
        $store = DB::table('stores')->where('Sid','=',$product->ProStoreId)->first();
        $storeCats = DB::table('store_cats')->where('SCStoreId','=',$store->Sid)->get();

        $storeSubCats = array();
        for ($i=0; $i < count($storeCats); $i++) {
            $sc = $storeCats[$i]->SCCId;
            $storeSubCats[] = DB::select("SELECT * FROM subcategories WHERE cat_id = $sc");
        }

        //dd($storeSubCats);
        if ($store->SUserId == $userId) {
            $productSuCats = DB::select("SELECT DISTINCT ProSubCatId, sub_cat_name_en FROM products JOIN subcategories ON ProSubCatId = id WHERE ProStoreId = $id");

            return view('products.edit')
            ->with('images',$images)
            ->with('product', $product)
            ->with('store', $store)
            ->with('storeSubCats', $storeSubCats)
            ->with('productSuCats', $productSuCats);
        }else {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(Request $request, $id)
    {
        //$subCatId = (int) $request->input('pro_subcat');
        $userId = Auth::user()->id;
        $productStoreId = DB::table('products')->where('ProId','=',$id)->first()->ProStoreId;
        $store = DB::table('stores')->where('Sid','=',$productStoreId)->first();

        // Update Points
        if ($request->has('storeStatus')) {
            if ($request->input('storeStatus') == 0) {
                $ProPoints = 0;
            }else{
                $ProPoints = $this->getPointsScheme($request->input('pro_price'));
            }
        }

        if ($store->SUserId == $userId) {

            $product = Product::where('ProId','=',$id);

            // Upload image
            $file = $request->file('pro_image');
            if ($request->hasFile('pro_image')) {



              foreach (  $file as $f) {

                $ext = strtolower($f->getClientOriginalExtension());
                $validExt = ['jpg','gif','jpeg','png'];


                if (in_array($ext, $validExt)) {
                    // the file is image
                    $filename = time().rand(1000,9999).'.'.$ext;
                $f->move(base_path().'/assets/images/products', $filename);

                    $quality = 10;
                    $image = base_path().'/assets/images/products/' . $filename;
                    $info = getimagesize($image);
                    //
                    if ($info['mime'] == 'image/jpeg'){
                        $soueceimage = imagecreatefromjpeg($image);
                        header("Content-Type: image/jpeg");
                        imagejpeg($soueceimage, base_path().'/assets/images/products/' . $filename, $quality);
                    }
                    elseif ($info['mime'] == 'image/gif') {
                        $soueceimage = imagecreatefromgif($image);
                        header('Content-Type: image/gif');
                        imagegif($soueceimage, base_path().'/assets/images/products/' . $filename, $quality);
                    }
                    elseif ($info['mime'] == 'image/png') {
                        $soueceimage = imagecreatefrompng($image);
                        header("Content-Type: image/png");
                        imagepng($soueceimage, base_path().'/assets/images/products/' . $filename);
                    }




                    Image::create([

                        'product_id'=>$id,
                        'imagePath'=>$filename

                                  ]);
                    // session()->flash('msg', '<i class="fa fa-check"></i> Updated Successfully');
                    // session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');

                }


                else{
                          // the file is not image
                          session()->flash('msg', '<i class="fa fa-close"></i> The file is not an image');
                          session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
                          return redirect("/");
                      }
                # code...
              }




            }

            // if (isset($upload)) {
                $product->update([
                    'ProName' => $request->input('pro_name'),
                    'ProSubCatId' => $request->input('pro_subcat'),
                    'ProPrice' => $request->input('pro_price'),
                    'ProPriceType' => $request->input('pro_pricetype'),
                    'ProCondition' => $request->input('pro_condition'),
                    'ProWarranty' => $request->input('pro_warranty'),
                    // 'ProDefaultImg' => $filename,
                    'ProDescription' => $request->input('pro_description'),
                    'ProVideo' => $request->input('pro_vidurl'),
                    'ProPoints' => $ProPoints
                ]);
            // }else{
            //     $product->update([
            //         'ProName' => $request->input('pro_name'),
            //         'ProSubCatId' => $request->input('pro_subcat'),
            //         'ProPrice' => $request->input('pro_price'),
            //         'ProPriceType' => $request->input('pro_pricetype'),
            //         'ProCondition' => $request->input('pro_condition'),
            //         'ProWarranty' => $request->input('pro_warranty'),
            //         'ProDescription' => $request->input('pro_description'),
            //         'ProVideo' => $request->input('pro_vidurl'),
            //         'ProPoints' => $ProPoints
            //     ]);
            // }


            session()->flash('msg', '<i class="fa fa-check"></i> Updated Successfully');
            session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');

            return redirect('product/'. $id .'/edit');
        }else {
            session()->flash('msg', '<i class="fa fa-close"></i> Can\'t update this product.');
            session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
            return redirect("/");
        }
    }


    /**
     * Add new product comment
     */
    public function addProductComment(Request $request)
    {
        if ($request->input('txtComment') != '') {
            $proComment = DB::table('productcomments')->insert([
                'ProComProId'=>$request->input('proid'),
                'ProComUserId'=>Auth::user()->id,
                'ProComText'=>$request->input('txtComment')
            ]);

            // Notification
            $commentId = DB::table('productcomments')->where('ProComUserId','=',Auth::user()->id)->where('ProComProId','=',$request->input('proid'))->orderBy('ProComId', 'desc')->first();
            $notifId = DB::table('notifs')->where('NotifActionId','=',$commentId->ProComProId)->where('NotifActionType','=','product')->orderBy('NotifId', 'desc')->first();
            
            $touser = DB::table('users')->where('id','=', $notifId->NotifUserId)->first();

            $theproduct = DB::table('products')->where('ProId','=', $commentId->ProComProId)->first();

            if (!empty($notifId)) {
                if ($notifId->NotifUserId != Auth::user()->id) {
                    DB::table('notifications')->insert([
                        'NNotifId'      => $notifId->NotifId,
                        'NReactedUserId'=> Auth::user()->id,
                        'NReactionId'   => $commentId->ProComId,
                        'NReactionType' => 'comment_product'
                    ]);

                    // Send user activation code
                    // From
                    $fromusername   = Auth::user()->name;
                    $fromuseremail  = Auth::user()->email;
                    $fromuserid  = Auth::user()->id;
                    
                    // To
                    $tousername     = $touser->name;
                    $touseremail    = $touser->email;

                    // Product
                    $productname    = $theproduct->ProName;
                    $productid      = $theproduct->ProId;

                    $subject = 'Some one commented on your product';
                    $message = view('emails.product_comment', [
                        'fromusername' => $fromusername ,
                        'fromuseremail' => $fromuseremail ,
                        'fromuserid' => $fromuserid ,
                        'tousername' => $tousername ,
                        'touseremail' => $touseremail ,
                        'productname' => $productname ,
                        'productid' => $productid ,
                    ]);

                    $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    mail($touseremail, $subject, $message, $headers);

                }
            }
        }
        echo "1";
    }


     public function deleteImage($id){

          // $imageId=$request->get('id');
          $image=Image::find($id);
          unlink(public_path()."/assets/images/products/".$image->imagePath);
          $image->delete();
          return redirect()->back();
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct($id)
    {
        $userId = Auth::user()->id;
        $product = DB::table('products')->where('ProId','=',$id)->first();
        $store = DB::table('stores')->where('Sid','=',$product->ProStoreId)->first();

        if ($store->SUserId == $userId) {
            DB::table('products')->where('ProId','=',$id)->delete();
            return redirect()->back();
        }else {
            return redirect('/');
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Product;
use App\Store;
use App\Storerate;
class StoresController extends Controller
{
    /**
     * Get All Stores
     */
    public function allstores()
    {
        $stores = DB::table('stores')->orderBy('Sid', 'desc')->get();
        return view('stores.allstores')->with('stores',$stores);
    }
    
    /**
     * Display a listing of the Stores.
     *
     * @return \Illuminate\Http\Response
     */
     
     //new updates
     
      public function rateStore(Request $request){
        $store_id =$request->get('store_id');
        $addOne=1;
        $star=$request->get('star');
        $store_rate=Storerate::where('store_id',$store_id)->first();
        if(is_null($store_rate)){
          if($star==1)
          Storerate::create([
         'store_id'=>$store_id,
         'star1'=>$addOne
          ]);
          if($star==2)
          Storerate::create([
         'store_id'=>$store_id,
         'star2'=>$addOne
          ]);
          if($star==3)
          Storerate::create([
         'store_id'=>$store_id,
         'star3'=>$addOne
          ]);
          if($star==4)
          Storerate::create([
         'store_id'=>$store_id,
         'star4'=>$addOne
          ]);
          if($star==5)
          Storerate::create([
         'store_id'=>$store_id,
         'star5'=>$addOne
          ]);
        }else{
            $exist=Storerate::where('store_id',$store_id)->first();
            if($star==1)
            $exist->star1=  $exist->star1+$addOne;
            if($star==2)
              $exist->star2=  $exist->star2+$addOne;
            if($star==3)
              $exist->star3=  $exist->star3+$addOne;
            if($star==4)
              $exist->star4=  $exist->star4+$addOne;
            if($star==5)
              $exist->star5=  $exist->star5+$addOne;
              $exist->save();
        }
return redirect()->back();
}
     
     //end of updates
    public function index()
    {
        if (Auth::check()) {
            $userAuth = Auth::user()->id;
            $userStores = DB::table('stores')->where('SUserId','=',$userAuth)->get();
            return view('stores.index')->with('userStores',$userStores);
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('stores.create')->with('categories',$categories);
    }

    /**
     * Store a newly created store in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('store_cat')){
        
	        $store = new Store;
	        $store_user = $request->input('rr')/50;
	        $store_name = $request->input('store_name');
	        $store_phone = $request->input('store_phone');
	        $store_email = $request->input('store_email');
	        $store_website = $request->input('store_website');
	        $store_desc = $request->input('store_desc');
	
	        if ($request->has('rr')) {$store->SUserId = $store_user;}
	        if ($request->has('store_name')) {$store->SName = $store_name;}
	        if ($request->has('store_phone')) {$store->SPhone = $store_phone;}
	        if ($request->has('store_email')) {$store->SEmail = $store_email;}
	        if ($request->has('store_website')) {$store->SWebsite = $store_website;}
	        if ($request->has('store_desc')) {$store->PDescription = $store_desc;}
	        $store->SCover = 'default.jpg';
	        $store->SImg = 'default.jpg';
	
	        // Date Of Creation and the expiry date (14 days)
	        $Date = date('Y-m-d');
	        $store->SCreatedAt = $Date;
	        $store->SExpireAt = date('Y-m-d', strtotime($Date. ' + 14 days'));
	
	        $store->save();
	
	        $storeId = DB::select("SELECT Sid FROM stores WHERE SUserId = $store_user AND SName = '$store_name' AND SPhone = '$store_phone' AND SEmail = '$store_email' AND SWebsite = '$store_website' AND PDescription = '$store_desc' ORDER BY Sid DESC LIMIT 1");
	
	        $sid = $storeId[0]->Sid;
	        foreach ($request->input('store_cat') as $key => $value) {
	            DB::table('store_cats')->insert([
	                'SCStoreId'=>$sid,
	                'SCCId'=>$value
	                ]);
	        }
	        return redirect("stores/$sid");
        
        }else{
        
        	return redirect()->back();
        
        }
    }

    /**
     * Display the specified Store.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $name = null)
    {
    
    //new updates
    
     $rating=Storerate::where('store_id',$id)->first();
      if(!is_null($rating)){
        $one=$rating->star1;
        $two=$rating->star2;
        $three=$rating->star3;
        $four=$rating->star4;
        $five=$rating->star5;
        $array=['star1'=>$one,'star2'=>$two,'star3'=>$three,'star4'=>$four,'star5'=>$five];
        $max=array_keys($array,max($array));
      }
    //end of updates
    	// Store number of views
        DB::table('stores')->where('Sid', $id)->increment('SViews');

        // Selecting the store
        if ($name != null) {
            $store = DB::table('stores')->where('Sid', '=', $id)->where('SName', '=', $name)->first();
        }else {
            $store = DB::table('stores')->where('Sid', '=', $id)->first();
        }

        $storeCats = DB::select("SELECT * FROM store_cats JOIN categories ON SCCId = id WHERE SCStoreId = $id");
        $storeFollowers = DB::select("SELECT count('SFUserId') AS flwrs FROM store_followers JOIN users ON SFUserId = id WHERE SFStoreId = $id");

        // The followers
        $theStoreFollowers = DB::select("SELECT * FROM store_followers JOIN users ON SFUserId = id WHERE SFStoreId = $id");

        if (Auth::check()) {
            $userId = Auth::user()->id;
            $IsUserFollow = DB::select("SELECT * FROM store_followers WHERE SFStoreId = $id AND SFUserId = $userId");
        }else{
            $IsUserFollow = array();
        }

        $storeSubCats = DB::select("SELECT * FROM subcategories JOIN store_cats ON cat_id = SCCId WHERE SCStoreId = $id");

        if (!empty($IsUserFollow)) {
            $IsUserFollowChk = 1;
        }else{
            $IsUserFollowChk = 0;
        }

        // Products
        $products = DB::select("SELECT * FROM products JOIN subcategories ON ProSubCatId = id WHERE ProStoreId = $id ORDER BY ProId DESC");
        $productSuCats = DB::select("SELECT DISTINCT ProSubCatId, sub_cat_name_ar, sub_cat_name_en FROM products JOIN subcategories ON ProSubCatId = id WHERE ProStoreId = $id");

        if (isset($store)) {
        
        
        //new updates
        
        
        
        if(!is_null($rating)){
          return view('stores.show')
          ->with('store', $store)
          ->with('storeCats', $storeCats)
          ->with('storeFollowers', $storeFollowers)
          ->with('IsUserFollowChk', $IsUserFollowChk)
          ->with('storeSubCats', $storeSubCats)
          ->with('products', $products)
          ->with('productSuCats', $productSuCats)
           ->with('theStoreFollowers', $theStoreFollowers)
          ->with('max',$max[0]);
        }
        //end of updates
        
        
        
            return view('stores.show')
            ->with('store', $store)
            ->with('storeCats', $storeCats)
            ->with('storeFollowers', $storeFollowers)
            ->with('IsUserFollowChk', $IsUserFollowChk)
            ->with('storeSubCats', $storeSubCats)
            ->with('products', $products)
            ->with('productSuCats', $productSuCats)
            ->with('theStoreFollowers', $theStoreFollowers);
        }else {
            return redirect('/');
        }

    }

    /**
     * Show the form for editing the specified Store.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = DB::table('stores')->where('Sid', '=', $id)->first();
        $categories = DB::table('categories')->get();
        $storeCategories = DB::table('store_cats')->where('SCStoreId', '=', $id)->get();

        if (isset($store)) {
            if(Auth::user()->id == $store->SUserId){
                return view('stores.edit')->with('store', $store)->with('categories', $categories)->with('storeCategories', $storeCategories);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified Store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $store_user = $request->input('rr')/50;

        if ($store_user == Auth::user()->id && !empty($request->input('store_cat'))) {

            $store_name = $request->input('store_name');
            $store_phone = $request->input('store_phone');
            $store_email = $request->input('store_email');
            $store_website = $request->input('store_website');
            $store_desc = $request->input('store_desc');

            DB::table('stores')->where('Sid', '=', $id)->update([
                'SUserId'     => $store_user,
                'SName'       => $store_name,
                'SPhone'      => $store_phone,
                'SEmail'      => $store_email,
                'SWebsite'    => $store_website,
                'PDescription'=> $store_desc
            ]);


            DB::table('store_cats')->where('SCStoreId', '=', $id)->delete();

            foreach ($request->input('store_cat') as $key => $value) {
                DB::table('store_cats')->insert([
                    'SCStoreId'=>$id,
                    'SCCId'=>$value
                    ]);
            }

            session()->flash('msg', '<i class="fa fa-check"></i> Updated Successfully');
            session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');

            return redirect("stores/$id");
        }

        session()->flash('msg', '<i class="fa fa-close"></i> Error');
        session()->flash('dis', 'style="display:block;background-color:#7f0600;"');

        return redirect("/");

        /*echo "<pre>";
        print_r($request->input('store_cat'));
*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::user()->id;
        $storeId = DB::table('stores')->where('Sid','=',$id)->first();

        if ($userId == $storeId->SUserId) {
            DB::table('stores')->where('Sid','=', $id)->delete();
            DB::table('products')->where('ProStoreId','=', $storeId->SUserId)->delete();

            session()->flash('msg', '<i class="fa fa-check"></i> Store deleted Successfully');
            session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');

            return redirect('stores/all');
        }else{
            return redirect()->back();
        }
    }


    /*
        Store Following
    */
    public function follow(Request $request)
    {
        $userId = Auth::user()->id;
        if ($request->has('store')) {
            $storeId = $request->input('store');
        }

        $IsUserFollow = DB::select("SELECT * FROM store_followers WHERE SFStoreId = $storeId AND SFUserId = $userId");

        if (empty($IsUserFollow)) {
            // make user follow store
            DB::table('store_followers')->insert([
                'SFStoreId'=>$storeId,
                'SFUserId'=>$userId
                ]);
        }

        return redirect('stores/' . $storeId);

    }

    public function unfollow(Request $request)
    {
        $userId = Auth::user()->id;
        if ($request->has('store')) {
            $storeId = $request->input('store');
        }

        $IsUserFollow = DB::select("SELECT * FROM store_followers WHERE SFStoreId = $storeId AND SFUserId = $userId");

        if (!empty($IsUserFollow)) {
            // make user follow store
            DB::table('store_followers')->where('SFUserId', '=', $userId)->delete();
        }

        return redirect('stores/' . $storeId);
    }

    /*
        Store Images
    */

    public function uploadCover(Request $r, $id){

        $file = $r->file('upcvr');

        if ($r->hasFile('upcvr')) {
            $ext = strtolower($file->getClientOriginalExtension());
            $validExt = ['jpg','gif','jpeg','png'];

            if (in_array($ext, $validExt)) {
                // the file is image
                $filename = time().rand(1000,9999).'.'.$ext;
                $upload = $file->move(base_path().'/assets/images/storecovers', $filename);

                if ($upload) {
                    DB::table('stores')->where('Sid', '=', $id)->update(['SCover'=> $filename]);
                }

                $url = url('/assets/images/storecovers/' . $filename);
                echo json_encode($url);

            }else{
                echo json_encode("Error");
            }

        }else{
            echo json_encode("Error");
        }
    }

    public function uploadImg(Request $r, $id){

        $file = $r->file('upimg');

        if ($r->hasFile('upimg')) {
            $ext = strtolower($file->getClientOriginalExtension());
            $validExt = ['jpg','gif','jpeg','png'];

            if (in_array($ext, $validExt)) {
                // the file is image
                $filename = time().rand(1000,9999).'.'.$ext;
                $upload = $file->move(base_path().'/assets/images/stores', $filename);

                if ($upload) {
                    DB::table('stores')->where('Sid', '=', $id)->update(['SImg'=> $filename]);
                }

                $url = url('/assets/images/stores/' . $filename);
                echo json_encode($url);

            }else{
                echo json_encode("Error");
            }

        }else{
            echo json_encode("Error");
        }
    }
}

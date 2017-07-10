<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class SearchController extends Controller
{
    /**
     * Display a listing of products.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $r)
    {
        $searchKey = $r->input('searchWhat');

        $profiles   = DB::table('users')->where('name','LIKE',"%$searchKey%")->orWhere('lastName','LIKE',"%$searchKey%")->get();
        $stores     = DB::table('stores')->where('SName','LIKE',"%$searchKey%")->get();
        $products   = DB::table('products')->where('ProName','LIKE',"%$searchKey%")->get();

        return view('search.search', [
            'profiles'=>$profiles,
            'stores'=>$stores,
            'products'=>$products
        ]);
    }

    /**
     * Display a listing of products.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchInstant(Request $r)
    {
        if(isset($_GET['searchWhat'])){
            $searchKey = $r->input('searchWhat');

            $profiles   = DB::table('users')->where('name','LIKE',"%$searchKey%")->orWhere('lastName','LIKE',"%$searchKey%")->get();
            $stores     = DB::table('stores')->where('SName','LIKE',"%$searchKey%")->get();
            $products   = DB::table('products')->where('ProName','LIKE',"%$searchKey%")->get();

            return view('search.search', [
                'profiles'=>$profiles,
                'stores'=>$stores,
                'products'=>$products
            ]);

        }else{
            $searchKey = $_GET['searchKey'];

            if (!empty($searchKey)) {
                $profiles   = DB::table('users')->where('name','LIKE',"%$searchKey%")->orWhere('lastName','LIKE',"%$searchKey%")->get();
                $stores     = DB::table('stores')->where('SName','LIKE',"%$searchKey%")->get();
                $products   = DB::table('products')->where('ProName','LIKE',"%$searchKey%")->get();

                $results = array();
                $counter = 0;

                foreach ($profiles as $key => $value) {
                    $results[$counter]['id'] = $value->id;
                    $results[$counter]['name'] = $value->name . ' ' . $value->lastName;
                    $results[$counter]['img'] = $value->uImg;
                    $results[$counter]['type'] = 'profiles';
                    $counter++;
                }
                foreach ($stores as $key => $value) {
                    $results[$counter]['id'] = $value->Sid;
                    $results[$counter]['name'] = $value->SName;
                    $results[$counter]['img'] = $value->SImg;
                    $results[$counter]['type'] = 'stores';
                    $counter++;
                }
                foreach ($products as $key => $value) {
                    $results[$counter]['id'] = $value->ProId;
                    $results[$counter]['name'] = $value->ProName;
                    $results[$counter]['img'] = $value->ProDefaultImg;
                    $results[$counter]['type'] = 'products';
                    $counter++;
                }

                $ret = "";

                for ($i=0; $i < count($results); $i++) { 
                    if ($results[$i]['type'] == 'products') {
                        $txt = 'product';
                    }
                    else if($results[$i]['type'] == 'stores'){
                        $txt = 'stores';
                    }
                    else if($results[$i]['type'] == 'profiles'){
                        $txt = 'profile';
                    }
                    
                    if ($txt == 'stores') {
                        $url = url($txt . '/' . $results[$i]['id'] . '/' . $results[$i]['name']);
                    }else {
                        $url = url($txt . '/' . $results[$i]['id']);
                    }

                    $img = url('assets/images/' . $results[$i]['type'] . '/' . $results[$i]['img']);
                    $name = $results[$i]['name'];
                    $ret .= '<a href="'. $url .'"><span class="searchResImg"><img src="'. $img .'"></span><span class="searchResTxt">'. $name .'</span></a>';
                }
                
                echo $ret;
            }else{
                echo 'No Results';
            }
        }
    }

    /**
     * Display a listing of products.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterShow()
    {
        $products   = DB::table('products')->get();
        $cats       = DB::table('categories')->get();
        $subcats    = DB::table('subcategories')->get();

        return view('search.filter',[
            'products'=>$products,
            'cats'=>$cats,
            'subcats'=>$subcats
            ]);
    }

    /**
     * Display a listing of products.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtering(Request $r)
    {    
        $cat    = ($r->has('cat'))? 'ProCatId = ' . $r->input('cat') : null ;
        $subcat = ($r->has('subcat'))? 'ProSubCatId = ' . $r->input('subcat') : null ;
        $cond   = ($r->has('cond'))? "ProCondition = '" . $r->input('cond') . "'" : null ;
        if ($r->has('price')) {
            if ($r->input('price') < 5000) {
                $price ='ProPrice <= ' . $r->input('price');
            }else{
                $price ='ProPrice >= ' . $r->input('price');
            }
        }else{
            $price = null ;
        }

        $cats   = DB::table('categories')->get();
        $subcats   = DB::table('subcategories')->get();

        $array = [$cat, $subcat, $cond, $price];
        $param = '';
        foreach ($array as $key => $value) {
            if ($value != null) {
                $param .= $value . ' and ';
            }
        }
        $param = substr($param, 0, -5);

        if ($cat == null && $subcat == null && $cond == null && $price == null) {
            $products = DB::select("select * from `products`");
        }else{
            $products = DB::select("select * from `products` where $param");
        }

        return view('search.filter',[
            'products'=>$products,
            'cats'=>$cats,
            'subcats'=>$subcats
            ]);
    }

}

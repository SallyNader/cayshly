<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Post;
use App\Store;
use App\Product;
use App\Notification;
use App\Comment;
 use App\Reply;
class MainPageController extends Controller
{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Display The Cats, Sub-Cats in the home page
        $categories = DB::table('categories')->get();
        $subcategories = DB::table('subcategories')->get();

        // posts
        $posts = DB::select("SELECT * FROM posts JOIN users ON PUserId = id ORDER BY PId DESC");

        // comments
        //$comments = DB::select("SELECT * FROM comments JOIN users ON CoUserId = id");
        
        $comments =Comment::all();
$replies=Reply::all();
        // posts likes
        $likes = DB::select("SELECT * FROM likes JOIN users ON LUserId = id");

        // Products
        $products = Product::where('ProShow','=',1)->orderby('created_at', 'desc')->get();

        // Stores
        $premStores = Store::where('SIsPlan','=',1)->orderby('created_at', 'desc')->get();

        $numbers = range(0, count($products) - 1);
        shuffle($numbers);
        $rand = [];
        $count = 0;

        foreach ($numbers as $number) {
            $rand[$number] = $products[$number];
            $count++;
        }

        // Hot Products
        $hotProducts = array();
        foreach ($categories as $category) {
            if (!empty(DB::select("SELECT * FROM products WHERE ProCatId = $category->id"))) {
                $hotProducts[] = DB::select("SELECT * FROM products WHERE ProCatId = $category->id");
            }
        }

        return view('main.home',[
            'categories'=>$categories,
            'subcategories'=>$subcategories,
            'posts'=>$posts,
            'comments'=>$comments,
            'likes'=>$likes,
            'products'=>$rand,
            'premStores'=>$premStores,
            'hotProducts'=>$hotProducts,
            'total'=>$this->getTotalPoints(),
             'replies'=>$replies
        ]);
    }

    // Load Posts
    public function loadpostsinhomepage()
    {
        $posts = DB::select("SELECT * FROM posts JOIN users ON PUserId = id ORDER BY PId DESC");
       // $comments = DB::select("SELECT * FROM comments JOIN users ON CoUserId = id");
       
       $comments =Comment::all();
       
        $replies=Reply::all();
        $likes = DB::select("SELECT * FROM likes JOIN users ON LUserId = id");

        echo view('main.loadPostsView',[
            'posts'=>$posts,
            'comments'=>$comments,
            'likes'=>$likes,
             'replies'=>$replies
        ]);
    }

    // Load Products
    public function loaditemsinhomepage($skip, $take)
    {
        // Display The Cats, Sub-Cats in the home page
        $categories = DB::table('categories')->get();
        $subcategories = DB::table('subcategories')->get();

        // Products
        $stores = DB::table('stores')->get();

        foreach ($stores as $store) {
            $products = Product::where('ProShow','=',1)->orderby('created_at', 'desc')->skip($skip)->take($take)->get();
        }
        // Random


        // rearrenge
        $numbers = range(0, count($products) - 1);
        shuffle($numbers);
        $rand = [];
        $count = 0;

        foreach ($numbers as $number) {
            $rand[$number] = $products[$number];
            $count++;
        }

        foreach ($rand as $randItem) {
            echo ' <div class="product">
                    <div class="product-in">
                        <div class="p-img"><a href="'. url("product/" . $randItem["ProId"]) .'"><img src="'. url("assets/images/products/" . $randItem["ProDefaultImg"]) .'" title="" class="tooltip"><a></div>
                        <div class="p-name"><p>'. $randItem["ProName"] .'</p></div>
                        <div class="p-data">
                            <div class="p-data-price">'. $randItem["ProPrice"] .' EGP</div>
                            <div class="p-data-points">'. $randItem["ProPoints"] .' Points</div>
                        </div>
                        <div class="p-process">
                            <div class="p-process-details" style="width:100%">
                                <a href="'. url("product/" . $randItem["ProId"]) .'">Details</a>
                            </div>
                        </div>
                    </div>
                </div> ';
        }
    }

    public function notif()
    {
        if (Auth::check()) {
            $userAuth = Auth::user()->id;

            // Get user stared notifications (Post, Product)
            $user_notifications_starts = DB::table('notifs')->where('NotifUserId','=',$userAuth)->get();

            // Get notefication reactions no user (Post, Product)
            $allNotifs = array();

            if (!empty($user_notifications_starts)) {
                foreach ($user_notifications_starts as $user_notifications_start) {
                    $allNotifsFrom = DB::select("SELECT * FROM notifications JOIN notifs ON NNotifId = NotifId JOIN users ON NReactedUserId = id WHERE NotifId = $user_notifications_start->NotifId");
                    array_push($allNotifs, $allNotifsFrom);
                }

                dd($allNotifs);
            }

        }else{
            echo "Not login";
        }
    }

}

<?php

//hotmail
Route::get('contact/import/hotmail',function(){ return view('free.invitehotmail');});
//google
Route::get('contact/import/google',function(){return view('free.invite');});

Route::get('invite/gmail/{email}','FreeSectionController@inviteGmail');
Route::get('invite/hotmail/{email}/{data}','FreeSectionController@inviteHotmail');
Route::get('gmailcontacts',function(){return view('contacts');});
Route::get('hotmail/result',function(){return view('free.resulthotmail');});
Route::get('inviteSelected','FreeSectionController@inviteSelected');

//free section
Route::resource('free','FreeSectionController');

/*----------------------------------------------------------------------------------------------------/
/--- Set Application Language
/----------------------------------------------------------------------------------------------------*/
Route::get('lang/{lang}', 'LangController@index');

Route::get("free/seeAll/{flag}","FreeSectionController@seeAll");
/*----------------------------------------------------------------------------------------------------/
/--- Temp - ( For application editing )
/----------------------------------------------------------------------------------------------------*/
// Upload Excel Sheet
Route::get('sheet', function() { return view('sheet'); });
// Update Points
Route::get('sss', 'PointsController@upPoints');
// Initial 5000 Points
Route::get('sendFHPoints', 'PointsController@sendFHPoints');
Route::get('/points/confirm', 'PointsController@confirmPoints');

// Emails
Route::get('/mail/{mfor}', function ($mfor) { return view('emails.' . $mfor); });
// Test Notification
Route::get('notif', 'MainPageController@notif');
Route::get('invite-twitter', function(){

return view('free.invitetwitter');
});
// Invite friend
Route::post('/invite', 'NetworkController@invitefriend');
/*----------------------------------------------------------------------------------------------------/
/--- Sign Page
/----------------------------------------------------------------------------------------------------*/
Route::post("auth/login/custom","AuthCayshly@login");
// SIGN UP Process 
// 1 - Basic informations
Route::get('/', 'AuthCayshly@signBasic');
// 2 - Optional informations
Route::post('auth/register/options','AuthCayshly@signOptional');
// 3 - Complete prosess and send activation
Route::post('auth/register/options/complete', 'AuthCayshly@signComplete');
Route::get('/mail/activate/{activationcode}', 'AuthCayshly@activateAccount');

Route::post('auth/ref/new', 'AuthCayshly@signRefNew');
// 4 - Sign Global
Route::get('auth/signin', 'AuthCayshly@signGlobal');




//start of new updates
Route::resource("reply","ReplyController");

route::post("like_product","ProductController@like");
route::post("unlike_product","ProductController@unlike");
Route::get('/resendcode', 'AuthCayshly@resendCode');
 //wishlist
 Route::get('delete/wishlist/{id}','WishListController@destroy');
 
 Route::post('rate','ProductController@rateProduct');
 Route::post('rate-store','StoresController@rateStore');
 
 Route::resource('wishlist','WishListController');
 Route::resource('request-product','RequestProductController');

Route::delete('testDelete/{id}','ProductController@deleteTest');

Route::get('/reporting/form',function(){


  return view('reporting.show');
});

Route::post('/reporting/send','ReportingController@sendReport');
//save post
 
 Route::get('save-post/{id}','PostController@savePost');
 Route::get('show-save-post','PostController@showSavedPosts');
 Route::get('remove-saved-post/{id}','PostController@removeSavedPost');

//end of new updates




























// SIGN IN Process
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// RESET PASSWORD
Route::get('/reset-password', 'AuthCayshly@getResetPassword');
Route::post('/reset-password', 'AuthCayshly@postResetPassword');

Route::get('/reset-password-activate/{code}', 'AuthCayshly@getResetPasswordActivate');
Route::post('/reset-password-activate/done', 'AuthCayshly@postResetPasswordActivateDone');

/*----------------------------------------------------------------------------------------------------/
/--- Cayshly global Pages
/----------------------------------------------------------------------------------------------------*/
Route::get('/about','globalPagesController@showAbout');
Route::get('/how-it-works','globalPagesController@showHowItWorks');
Route::get('/terms','globalPagesController@showTerms');
Route::get('/privacy','globalPagesController@showPrivacy');
Route::get('/f-and-q','globalPagesController@showFAndQ');
Route::get('/contact','globalPagesController@showContact');

/*----------------------------------------------------------------------------------------------------/
/--- Cayshly Core App Pages
/----------------------------------------------------------------------------------------------------*/

// Home Page Access Globaly and guest can't post, like, comment, share
Route::get('/home', 'MainPageController@index');
Route::get('/loaditemsinhomepage/{skip}/{take}', 'MainPageController@loaditemsinhomepage');

Route::get('/loadpostsinhomepage', 'MainPageController@loadpostsinhomepage');

// Shopping Cart
Route::get('/cart', 'CartController@showAllProductsToCart');
Route::post('/cart/add/{id}', 'CartController@addProductToCart')->where('id', '[0-9]+');
Route::get('/cart/delete/{id}', 'CartController@deleteProductFromCart')->where('id', '[0-9]+');

// Search
Route::get('/search/results/', 'SearchController@searchInstant');

// Filter
Route::get('/filter','SearchController@filterShow');
Route::get('/filter/data','SearchController@filtering');

// Products . Show the product
Route::get('product/{id}', 'ProductController@show')->where('id', '[0-9]+');

// Category
Route::get('category/{id}', 'CategoryController@showRelatedCats')->where('id', '[0-9]+');

// Pricing
Route::get('pricing', 'PricingController@index');
Route::get('pricing/go/{package}', 'PricingController@goPackageGet');
Route::post('pricing/go/package', 'PricingController@goPackagePost');

// Show profile
Route::get('profile/{id}', 'UserProfileController@show');

// Buy
Route::put('/buy', 'CartController@buy');

// All Stores
Route::get('/all-stores', 'StoresController@allstores');

Route::get('delete/image/{id}','ProductController@deleteImage');

// The Main Middleware for auth users and the pages that they can access    
Route::group(['middleware'=>'auth'], function(){
    // Change PASSWORD
    Route::get('/change-password', 'UserProfileController@getChPsPage');
    Route::post('/change-password', 'UserProfileController@postChPsPage');
    
    // Products
    Route::post('product/store', 'ProductController@store');
    Route::post('product/comment/add', 'ProductController@addProductComment');

    Route::get('product/{id}/edit', 'ProductController@editProduct');
    Route::post('product/{id}/edit', 'ProductController@updateProduct');
    Route::delete('product/{id}/delete', 'ProductController@deleteProduct');

    // Profiles
    Route::get('profile/{id}/edit', 'UserProfileController@edit');
    Route::post('profile/{id}/edit', 'UserProfileController@update');
    // Profile Images
    Route::put('profile/{id}/upcvr', 'UserProfileController@uploadCover');
    Route::put('profile/{id}/upimg', 'UserProfileController@uploadImg');

    // Stores
    Route::get('stores/all', 'StoresController@index');
    Route::get('stores/create', 'StoresController@create');
    Route::post('stores/store', 'StoresController@store');
    Route::get('stores/{id}/edit', 'StoresController@edit');
    Route::post('stores/{id}/edit', 'StoresController@update');
    Route::delete('stores/{id}/delete', 'StoresController@destroy');

    // Start of new update
      Route::put('store/follow', 'StoresController@follow');
    Route::put('store/unfollow', 'StoresController@unfollow');
    
    //end of new updates
    // Store Images
    Route::put('store/{id}/upcvr', 'StoresController@uploadCover');
    Route::put('store/{id}/upimg', 'StoresController@uploadImg');

    // Posts
    Route::put('post/store','PostController@store');
    Route::get('delete/post/{id}','PostController@destroy');
    Route::get('edit/post/{id}','PostController@edit');
    Route::post('edit/post/{id}','PostController@update');
    Route::get('show/post/{id}','PostController@show');
    // Commnets
    Route::post('comment/store','CommentController@store');
    // Like
    Route::get('post/{id}/like','LikeController@like');
    Route::get('post/{id}/unlike','LikeController@unlike');

    // Notification
    Route::get('/notification', 'NotificationController@index');
    Route::get('/updatenumofnotis', 'NotificationController@updateNumOfNotis');

    // Points
    Route::get('/points', 'PointsController@getAllPoints');

    // Request New Product
    Route::get('/request-new-product', function () {return view('request-new-product.show');});

    // Network
    Route::get('/network', 'NetworkController@myNetwork');
    Route::get('/grow-network', function () {
    $parentMail=Auth::user()->email;
    return view('network.grow-network',compact('parentMail'));
    
    
    });

    // Buy
    Route::post('/buy/done', 'CartController@buyDone');

    // Message
    Route::get('/messaging', 'MessageController@index');
    Route::get('/messaging/new/{uderid}/{clientid}', 'MessageController@create');
    Route::get('/messaging/thread/{id}', 'MessageController@show');
    Route::post('/messaging/add', 'MessageController@add');

});

// Show Store
Route::get('stores/{id}/{name?}', 'StoresController@show')->where('id', '[0-9]+');

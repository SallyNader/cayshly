<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // The Posts, Products, .. That the user created (notifs)

        // Get All interactions on the Posts, Products, .. from other users // echo(strtotime("last Sunday"));
        $user_notifs = DB::table('notifs')
        ->join('notifications','NNotifId','=','NotifId')
        ->join('users','id','=','NReactedUserId')
        ->where('NotifUserId','=',Auth::user()->id)
        ->orderBy('NId','DESC')
        ->get();

        $user_alerts = DB::table('alerts')
        ->join('users','id','=','alert_from')
        ->where('alert_to','=',Auth::user()->id)
        ->orderBy('alert_id','DESC')
        ->get();

        return view('notification.show', ['user_notifs'=>$user_notifs, 'user_alerts'=>$user_alerts]);
    }

    /**
     * Update the number of notifications showed by the user
     */
     public function updateNumOfNotis(){
      //  DB::table('users')->update([
      //    'showed_notifications' => 0
      //  ]);

      // Get All interactions on the Posts, Products, .. from other users
      $user_notifs = DB::table('notifs')
      ->join('notifications','NNotifId','=','NotifId')
      ->join('users','id','=','NReactedUserId')
      ->where('NotifUserId','=',Auth::user()->id)
      ->orderBy('NId','DESC')
      ->get();

      $user_alerts = DB::table('alerts')
      ->join('users','id','=','alert_from')
      ->where('alert_to','=',Auth::user()->id)
      ->orderBy('alert_id','DESC')
      ->get();

       $count_user_interactions = count($user_notifs) + count($user_alerts);
       if ($count_user_interactions > Auth::user()->showed_notifications) {
         DB::table('users')->where('id', Auth::user()->id)->update([
           'showed_notifications' => $count_user_interactions
         ]);
         echo '1';
       }else {
         echo '0';
       }

     }

}

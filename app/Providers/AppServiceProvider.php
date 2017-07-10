<?php

namespace App\Providers;
use App\User;
use Auth;
use DB;
use Illuminate\Support\ServiceProvider;
use App\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.main-master', function($view)
        {
            if (Auth::check()) {

                // Get User Stores
                $userStores = DB::table('stores')->where('SUserId','=',Auth::user()->id)->get();

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

                $view->with('userStores',$userStores)->with('user_notifs',$user_notifs)->with('user_alerts',$user_alerts);

            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

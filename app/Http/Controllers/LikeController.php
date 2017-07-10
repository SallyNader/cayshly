<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Like;

class LikeController extends Controller
{

    /**
     * User like post
     * @param  int  $id
     * @return void
     */
    public function like(Request $r, $id)
    {
        if(Auth::check()){
            $postId = $id;
            $userId = Auth::user()->id;

            $like = new Like();
            $like->LPostId = $postId;
            $like->LUserId = $userId;

            $like->save();

            // Notification
            $likeId = DB::table('likes')->where('LUserId','=',$userId)->where('LPostId','=',$postId)->orderBy('LId', 'desc')->first();
            $notifId = DB::table('notifs')->where('NotifActionId','=',$likeId->LPostId)->where('NotifActionType','=','post')->orderBy('NotifId', 'desc')->first();
           
            $touser = DB::table('users')->where('id','=', $notifId->NotifUserId)->first();

            $thepost = DB::table('posts')->where('PId','=', $likeId->LPostId)->first();
            
            if (!empty($notifId)) {
                if ($notifId->NotifUserId != Auth::user()->id) {
                    DB::table('notifications')->insert([
                        'NNotifId'=>$notifId->NotifId,
                        'NReactedUserId'=>$userId,
                        'NReactionId'=>$likeId->LId,
                        'NReactionType'=>'like_post'
                    ]);

                    // Send email
                    // From
                    $fromusername   = Auth::user()->name;
                    $fromuseremail  = Auth::user()->email;
                    $fromuserid  = Auth::user()->id;
                    
                    // To
                    $tousername     = $touser->name;
                    $touseremail    = $touser->email;

                    // Product
                    $postTxt    = $thepost->PText;
                    $postid     = $thepost->PId;

                    $subject = 'Some one liked your post';
                    $message = view('emails.post_like', [
                        'fromusername' => $fromusername ,
                        'fromuseremail' => $fromuseremail ,
                        'fromuserid' => $fromuserid ,
                        'tousername' => $tousername ,
                        'touseremail' => $touseremail ,
                        'postTxt' => $postTxt ,
                        'postid' => $postid ,
                    ]);

                    $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    mail($touseremail, $subject, $message, $headers);
                }
            }

            echo "1";

        }else{
            return redirect()->back();
        }
    }

     /**
     * User unlike post
     * @param  int  $id
     * @return void
     */
    public function unlike(Request $r, $id)
    {
        if(Auth::check()){
            $postId = $id;
            $userId = Auth::user()->id;

            DB::table('likes')->where('LPostId','=',$postId)->where('LUserId','=',$userId)->delete();

            echo "1";
        }else{
            return redirect()->back();
        }
    }
}

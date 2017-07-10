<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        if ($request->has('comment')) {
            $comment->CoPostId  = $request->input('cpi');
            $comment->CoUserId  = Auth::user()->id;
            $comment->CoText    = $request->input('comment');

            $comment->save();

            // Notification
            $commentId = DB::table('comments')->where('CoUserId','=',Auth::user()->id)->where('CoPostId','=',$request->input('cpi'))->orderBy('CoId', 'desc')->first();
            $notifId = DB::table('notifs')->where('NotifActionId','=',$commentId->CoPostId)->where('NotifActionType','=','post')->orderBy('NotifId', 'desc')->first();

            $touser = DB::table('users')->where('id','=', $notifId->NotifUserId)->first();

            $thepost = DB::table('posts')->where('PId','=', $commentId->CoPostId)->first();
            
            if (!empty($notifId)) {
                if ($notifId->NotifUserId != Auth::user()->id) {
                    DB::table('notifications')->insert([
                        'NNotifId'=>$notifId->NotifId,
                        'NReactedUserId'=>Auth::user()->id,
                        'NReactionId'=>$commentId->CoId,
                        'NReactionType'=>'comment_post'
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
                    $postTxt    = $thepost->PText;
                    $postid     = $thepost->PId;

                    $subject = 'Some one commented on your post';
                    $message = view('emails.post_comment', [
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

            $theUser = Auth::user()->id;
            $thepost = $request->input('cpi');

            $lastComment = DB::select("SELECT * FROM comments JOIN users ON CoUserId = id WHERE CoUserId = $theUser AND CoPostId = $thepost ORDER BY CoId DESC LIMIT 1");

            echo json_encode($lastComment);
        }else{
            // No text in the post
            session()->flash('msg', '<i class="fa fa-close"></i> Please type a comment');
            session()->flash('dis', 'style="display:block;background-color:#7f0600;"');

            return redirect()->back();
        }
    }
    
}

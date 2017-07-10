<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class NetworkController extends Controller
{

    /**
     * Show user's network (parent, members)
     */
    public function myNetwork()
    {
        $uNetwork = DB::table('users')->where('id','=', Auth::user()->id)->first();
        $uParent = DB::table('users')->where('id','=', "$uNetwork->parentEmail")->first();
        
        if ($uParent == "") {
            $uParent = 0;
        }

        /**
         * Get user's network members
         */
        $allMembers = [];
        function getUserMembers($userId)
        {
            global $allMembers;
            $members = DB::table('users')->where('parentEmail', '=', $userId)->get();
            foreach ($members as $member) {
                $allMembers[] = $member;
                getUserMembers($member->id);
            }
            
            return $allMembers;
        }

        //dd(getUserMembers(Auth::user()->id));

        return view('network.my-network',[
            'uNetwork'=>$uNetwork,
            'uParent'=>$uParent,
            'allMembers'=>getUserMembers(Auth::user()->id)
        ]);
    }

    /**
     * Invite Your Friend
     */
    public function invitefriend(Request $request)
    {
        if ($request->has('femail')) {

            $sendername = Auth::user()->name;
            $lastname = Auth::user()->lastname;
            $parentmail  = Auth::user()->email;
            
            $data = [
                'fname'=>$sendername,
                'lname'=>$lastname,
                'uid'=> Auth::user()->id,
                'parentmail'=>$parentmail
            ];

            $receiver = $request->input('femail');

            $subject = 'Your Friend ' . $sendername . ' Invite you to cayshly';
            $message = view('emails.invite', $data);

            $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
            $headers .= "BCC: ". config('maildata.bcc') ."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            if (mail($receiver, $subject, $message, $headers)) {
                session()->flash('msg', '<i class="fa fa-check"></i> We Invited your friend');
                session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');
                
                return redirect()->back();
            }else{
                session()->flash('msg', '<i class="fa fa-close"></i> Error');
                session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
                
                return redirect()->back();
            }
        }else{
            session()->flash('msg', '<i class="fa fa-close"></i> Error');
            session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
            
            return redirect()->back();
        }
    }
}
 
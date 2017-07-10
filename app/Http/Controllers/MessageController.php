<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $Msgs[] = DB::select("SELECT * FROM messages JOIN users ON MsgClientId = id WHERE MsgUserId = $userId");
        $Msgs[] = DB::select("SELECT * FROM messages JOIN users ON MsgUserId = id WHERE MsgClientId = $userId");

        $MsgsConvs = 'NO';
        $MsgID = 'NO';

        return view('message.index', ['Msgs'=>$Msgs, 'MsgsConvs'=>$MsgsConvs, 'MsgID'=>$MsgID]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uderid, $clientid)
    {
        $userId = $uderid;
        $clientId = $clientid;

        if (Auth::user()->id == $userId) {
            $getMsg = DB::table('messages')->where('MsgUserId','=',$userId)->where('MsgClientId','=',$clientId)->first();
            if($getMsg == null){
                $msg = new Message();
                $msg->MsgUserId = $userId;
                $msg->MsgClientId = $clientId;
                $msg->save();
                $getMsgG = DB::table('messages')->where('MsgUserId','=',$userId)->where('MsgClientId','=',$clientId)->first();
                return redirect('messaging/thread/'. $getMsgG->MsgId);
            }else{
                return redirect('messaging/thread/'. $getMsg->MsgId);
            }
        }else{
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
        $userId = Auth::user()->id;
        $Msgs[] = DB::select("SELECT * FROM messages JOIN users ON MsgClientId = id WHERE MsgUserId = $userId");
        $Msgs[] = DB::select("SELECT * FROM messages JOIN users ON MsgUserId = id WHERE MsgClientId = $userId");
        
        $MsgsConvs = DB::select("SELECT * FROM messageconvers JOIN users ON MsgConvUserId = id WHERE MsgConvMsgId = $id");
        $MsgID = $id;

        return view('message.index', ['Msgs'=>$Msgs, 'MsgsConvs'=>$MsgsConvs, 'MsgID'=>$MsgID]);
    }

    /**
     * Add new message
     */
    public function add(Request $request)
    {
        $ms = $request->input('ms');
        $convText = $request->input('convText');

        DB::insert('insert into messageconvers (MsgConvMsgId, MsgConvUserId, MsgConvTxt) values (?, ?, ?)', [$ms, Auth::user()->id, $convText]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

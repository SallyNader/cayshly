<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
class ReportingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function sendReport(Request $request){



          $name=$request->get('name');

          $email=$request->get('email');
          $phone=$request->get('phone');
          $typeOfProblem=$request->get('problem');
          $description=$request->get('desc');

          $data=[


          'name'=>$name ,
          'email'=> $email,
          'phone'=> $phone,
          'problemType'=>$typeOfProblem  ,
          'description'=>  $description


          ];

          $receiver="sallynaderahmed@gmail.com";

          $subject="reporting problem";

          $message=view('template.report',$data);


          $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
          $headers .= "BCC: ". config('maildata.bcc') ."\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

          




Mail::send('template.report', ['name' => $name,'email'=>$email,'phone'=>$phone,'problemType'=>$typeOfProblem,'description'=>$description], function($message) use($name,$phone,$typeOfProblem,$email,$description)
{
    $message->from('info@Cayshly.com','Cayshly');
    $message->to('info@Cayshly.com', 'Support')->subject('Report Problem');
});


            //mail($receiver,$subject,$message,$headers);
            session()->flash('msg', '<i class="fa fa-check"></i> your report was submitted');
            session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');

            return redirect()->back();

          


     }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pricing.show');
    }

    /**
     * Go Package Get
     */
    public function goPackageGet($package)
    {
        if ($package == "free") {
           return redirect('/');
        }
        elseif ($package == "silver" || $package == "golden" || $package == "platinum") {
            return view('pricing.go_package', ['package'=>$package]);
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Go Package Post
     */
    public function goPackagePost(Request $r)
    {
        $name = $r->get('name');
        $email = $r->get('email');
        $phone = $r->get('phone');
        $package = $r->get('package');

        if ($package == "silver" || $package == "golden" || $package == "platinum") {

            $message = "Name : $name";
            $message .= "Email : $email\n";
            $message .= "Phone : $phone\n";
            $message .= "Package : $package\n";

            $headers = "From: Cayshly<". config('maildata.from') ."> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            mail('ttaheraly@gmail.com,ahmsam39@yahoo.com', "Cayshly Package ($package) Request", $message, $headers);

            session()->flash('msg', '<i class="fa fa-check"></i> Done, We will contact you.');
            session()->flash('dis', 'style="display:block;background-color:#1D80F0;"');
            return redirect()->back();
        }
        else{
            session()->flash('msg', '<i class="fa fa-close"></i> Error');
            session()->flash('dis', 'style="display:block;background-color:#7f0600;"');
            return redirect()->back();
        }
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class globalPagesController extends Controller
{
    public function showAbout(){
    	return view('global.about');
    }
    public function showHowItWorks(){
    	return view('global.how-it-works');
    }
    public function showTerms(){
    	return view('global.terms');
    }
    public function showPrivacy(){
    	return view('global.privacy');
    }
    public function showFAndQ(){
    	return view('global.f-and-q');
    }
    public function showContact(){
    	return view('global.contact');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lang)
    {
        $langs = ['ar','en'];
        if(in_array($lang, $langs)){
            session()->put('lang', $lang);
            return redirect()->back();
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrawlItController extends Controller
{
    /**
     * Home page
     */

    public function home(){
        return view("home");
    }

    public function crawl(Request $request){
        dd($request->all());
    }
}

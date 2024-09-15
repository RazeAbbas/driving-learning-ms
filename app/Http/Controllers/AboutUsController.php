<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        $data = array(
            'page_title' => "About Us",
        );
        return view('about-us',$data);
    }
}

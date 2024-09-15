<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Models\Categories;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $singular = "Home";
    private $view = "home";


    public function index()
    {
        $data = array(
            'page_title' => $this->singular,
            "courses" => Course::where('is_featured','yes')->get(),
            "categories"=> Categories::all(),
        );

        return view('home',$data);
    }
}

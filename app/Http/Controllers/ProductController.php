<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list(){
        $name = "Tanduay";

       return view('products.list',[
        'pruducts_name' => $name
       ]);
    }
}

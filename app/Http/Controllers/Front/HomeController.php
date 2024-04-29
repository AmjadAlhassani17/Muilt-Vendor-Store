<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Fasades\Cart;

class HomeController extends Controller
{
    //
    public function index()
    {
        $products = Product::active()->latest()->limit(8)->get();
        return view('front.index' , compact('products'));
    }
}
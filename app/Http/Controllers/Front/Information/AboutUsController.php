<?php

namespace App\Http\Controllers\Front\Information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        return view('front.information.about-us');
    }
}
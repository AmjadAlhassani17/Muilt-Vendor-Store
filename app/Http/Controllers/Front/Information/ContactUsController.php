<?php

namespace App\Http\Controllers\Front\Information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('front.information.contact-us');
    }
}
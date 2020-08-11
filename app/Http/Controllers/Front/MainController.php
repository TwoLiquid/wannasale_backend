<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function home()
    {
        return redirect()->route('register');
        // return view('front.welcome');
    }
}

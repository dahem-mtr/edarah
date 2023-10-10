<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Index');
    }

    public function changeLang($lang)
    {
        Cookie::queue(Cookie::forever("lang", $lang));
          return back();
    }
    public function darkToggle()
    {
        if(Cookie::get('dark-mode')) {
            Cookie::queue(Cookie::forget('dark-mode'));
        }  else {
            Cookie::queue(Cookie::forever("dark-mode", true));
        }
          return back();
    }
}

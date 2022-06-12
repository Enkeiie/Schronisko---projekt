<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view("home");
    }

    public function firstboot()
    {
        if(Auth::user()->address!=null || Auth::user()->shelter!=null){
            return redirect()->back();
        }
        return view('first-boot');
    }

    public function articles($id){
        Switch($id){
            case 1:
                return view('article-1');
                break;
            case 2:
                return view('article-2');
                break;
            case 3:
                return view('article-3');
                break;
        }
        return redirect()->back();
    }
}

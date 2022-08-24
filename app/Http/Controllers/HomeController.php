<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {

        $info   = Seo::select('*')
                    ->where('seo_alias', '/')
                    ->first();

        return view('main.home.home', compact('info'));
        
    }
}

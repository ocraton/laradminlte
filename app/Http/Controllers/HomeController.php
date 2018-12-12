<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Locazione;
use App\User;
use App\Ups;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $locazioni = Locazione::with('ups')->get();
        $ups = Ups::where('stato', 2)->orWhere('stato', 1)->with('locazione')->get();        
        return view('home.home', compact('locazioni', 'ups'));
    }
}

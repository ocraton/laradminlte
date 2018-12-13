<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Locazione;
use App\User;
use App\Ups;
use Auth;

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
        $role = Auth::user()->getRoleNames();
        switch ($role[0]) {

            case 'cliente':                
                $ups = Ups::where('stato', 2)->whereHas('locazione', function($q) {
                    $q->where('user_id', Auth::id());
                })->orWhere('stato', 1)->whereHas('locazione', function($q) {
                    $q->where('user_id', Auth::id());
                })->get();
                $locazioni = Locazione::where('user_id', Auth::id())->with('ups')->get();
                break;
            
            default:
                $ups = Ups::where('stato', 2)->orWhere('stato', 1)->with('locazione')->get();
                $locazioni = Locazione::with('ups')->get();
                break;
        }
                
        return view('home.home', compact('locazioni', 'ups'));
    }
}

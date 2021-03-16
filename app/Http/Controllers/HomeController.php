<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

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
        if(Auth::user()->usertype == 1)
        {
            return view('home');
        }
        else if(Auth::user()->usertype == 2){
            $dept = Auth::user()->department;
            $data = count(DB::table('request_items')->where('department',$dept)->where('approval_status','pending')->get()->toArray());
            return view('home')->with('data',$data);
        }

        else if(Auth::user()->usertype == 3){
            $data = count(DB::table('request_items')->where('approval_status','approved_by_hod')->get()->toArray());
            return view('home')->with('data',$data);
        }
        else if(Auth::user()->usertype == 4){
            $data = count(DB::table('request_items')->where('approval_status','approved_by_moderator')->get()->toArray());
            return view('home')->with('data',$data);
        }
        
    }
}

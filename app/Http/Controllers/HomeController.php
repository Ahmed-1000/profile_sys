<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\post;

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
    public function indexV()
    {
       
        return view('profile.index');
    }
    public function home(post $post){

          $post = post::all();
         return view('home', compact('post'));
    }
    public function chatview(){
         return view('profile.message');
    }
    public function view_one($id){
       $userfind = User::find($id);
         return view('profile.message', compact('userfind'));
    }
}

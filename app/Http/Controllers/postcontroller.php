<?php

namespace App\Http\Controllers;

use  Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;

use App\Models\post;
use App\Models\User;


class postcontroller extends Controller
{

    public function __construct(){

          $this->middleware('auth');
    }
    public function create(){

        return view('posts.create');
    }
    public function store(Request $request){
           $data = $request->validate([
                  'caption' =>'required',
                  'image' =>['required','image'],

           ]);

           $imagepath = request('image')->store('uploads','public');

           

           Auth::user()->post()->create([
                'caption' => $data['caption'],
                'image' => $imagepath,
           ]);

           return redirect('/profile/'.Auth::user()->id);
    }
    public function show(post $post){
         
         return view('posts.show',compact('post'));
    }
}

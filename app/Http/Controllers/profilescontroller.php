<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use  Illuminate\Support\Facades\Auth;

class profilescontroller extends Controller
{
     public function index($user)
    {
        
        $User = User::findOrFail($user);
        return view('profile.index',compact('User' ));
    }
    public function edit(User $user){

       $this->authorize('update', $user->profile);

       return view ('profile.edit',compact('user'));
    }
    public function update(Request $request, User $user){
       $this->authorize('update', $user->profile);
       $data = $request->validate([
          'title' => 'required',
          'description' => 'required',
          'url' => 'url',
          'image' => '',
       ]);

       

       if($request->image){
            $imagepath = request('image')->store('profile','public');
       }

       Auth::user()->profile->update(array_merge(
            $data,
            ['image' => $imagepath ]
       ));

       return redirect("/profile/{$user->id}");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use  Illuminate\Support\Facades\Auth;

class followscontroller extends Controller
{
    public function store(User $user ){

         return auth()->user()->following()->toggle($user->profile);
    }
}

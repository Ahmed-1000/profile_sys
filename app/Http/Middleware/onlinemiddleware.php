<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use  Illuminate\Support\Facades\Session;
use App\Models\User;
use  Illuminate\Support\Facades\Cache;

class onlinemiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user_to_offline = User::where('last_active','<',now());
        $user_to_online = User::where('last_active','>=',now());
        if(isset( $user_to_offline)){
             $user_to_offline->update(['is_online'=> false]);
        }if(isset($user_to_online)){
               $user_to_online->update(['is_online'=> true]);
        }
        if(auth()->check()){
            $cache_value = Cache::put('user-is-online',auth()->id(), \Carbon\Carbon::now()->addMinutes(1));
            $user = User::find(Cache::get('user-is-online'));
            $user->last_active = now()->addMinutes(1);
            $user->is_online = true;
            $user->save();
        }elseif(!auth()->check() and filled(Cache::get('user-is-online'))){
            $user = User::find(Cache::get('user-is-online'));
            if(isset($user)){
                $user->is_online = false;
                $user->save();
            }
        }
        return $next($request);
    }
}

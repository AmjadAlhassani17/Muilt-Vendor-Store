<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , ...$type): Response
    {
        $user = Auth::user();
        //dd($user);
        if(!$user){
            return Redirect::route('login');
        }
        if(!in_array($user->user_type , $type)){
            return Redirect::route('home');
        }
        
        return $next($request);
    }
}
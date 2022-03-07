<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(Auth::guard('api')->check()){
            $user = $request->user('api');
            if($user->role === $role){
                return $next($request);
            } else {
                return response()->json(['message' => 'Unauthorized!'], 401);
            }
        } else {
            return response()->json(['error' => 'User not logged in!'], 401);
        }

        

    }
}
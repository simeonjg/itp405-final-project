<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class DenyBlockedUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isBlocked = Auth::user()->is_blocked;
        $isNotBlocked = !$isBlocked;
        $requestedRouteName = $request->route()->getName();

        // redirect users to blocked page if they are blocked and try to access any other page
        if($isBlocked && $requestedRouteName !== 'blocked'){
            return redirect()->route('blocked');
        }

        // don't let users access the blocked page if they aren't blocked
        if($isNotBlocked && $requestedRouteName == 'blocked'){
            return redirect()->route('profile.index');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @return Response
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        // if user not logged in or logged in but don't have a given role
        // redirect to ant route like 403 or any view with message
        if( !$request->user() || !$request->user()->hasRole($role)){
            abort(403);
        }
        return $next($request);
    }
}

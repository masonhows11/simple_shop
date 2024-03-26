<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminVerified
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth_admin = Auth::guard('admin')->user();
        if($auth_admin->email_verified_at == null){
            session()->flash('error',__('messages.user_unverified'));
            return redirect()->route('admin.login.form');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Sentinel;
use Illuminate\Support\Facades\Response;

class AuthMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    protected $api;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $check = Sentinel::check();

        if (!$check) {
            // API Response otherwise redirect
            if ($request->ajax() || $request->wantsJson()) {
                $errCtrl = new Controller();
                return $errCtrl->respondUnauthorized("User is not logged in!");
            } else {
                return redirect()->guest('/backend/login');
            }
        }

        return $next($request);
    }
}

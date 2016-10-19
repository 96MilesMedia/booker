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
            $errCtrl = new Controller();

            return $errCtrl->respondUnauthorized(USER_NOT_LOGGED_IN);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Constants\RoleConstants;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->hasRole(RoleConstants::ADMIN)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}

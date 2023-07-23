<?php

namespace App\Http\Middleware;

use App\Constants\RoleConstants;
use Closure;
use Exception;

class AdminMiddleware
{
    /**
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->hasRole(RoleConstants::ADMIN)) {
            return $next($request);
        }
        throw new Exception('Unauthorized action.', 403);

    }
}

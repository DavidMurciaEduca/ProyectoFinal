<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminGerenteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->tipo_usuario != 'admin' && $request->user()->tipo_usuario != 'gerente')
        {
            abort(403);
        }

        return $next($request);
    }
}

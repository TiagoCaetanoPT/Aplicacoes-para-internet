<?php

namespace App\Http\Middleware;

use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Closure;

class IsDirecao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->ativo == 1 && $request->user()->password_inicial == 0 && $request->user()->deleted_at == null && $request->user()->direcao) {
            return $next($request);
        }

        throw new AccessDeniedHttpException('Unauthorized.');
    }
}

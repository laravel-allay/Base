<?php

namespace Allay\Base\app\Http\Middleware;

use Closure;

class IsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws UserNotVerifiedException
     */
    public function handle($request, Closure $next)
    {
        // User is not verified, but logged in
        if (!$request->user()->verified) {
            return redirect()->route('email-verification.verify');
        }

        return $next($request);
    }
}

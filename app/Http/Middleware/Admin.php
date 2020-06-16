<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if ($request->is('*' . config('app.admin_url') . '*')) {
            if (empty($user = auth()->user())) {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}

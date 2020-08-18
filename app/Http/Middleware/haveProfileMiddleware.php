<?php

namespace App\Http\Middleware;

use Closure;

class haveProfileMiddleware
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
        if (auth()->user()->createdByProfiles()->count() < 1 && !auth()->user()->is_admin) {
            return redirect()->route('admin.profiles.create');
            abort(403);
        }

        return $next($request);
    }
}

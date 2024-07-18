<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckNewActivities
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $hasNewActivities = Activity::hasNewActivities(Auth::id());
            view()->share('hasNewActivities', $hasNewActivities);
        }

        return $next($request);
    }
}

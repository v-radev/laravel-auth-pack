<?php namespace App\Clusters\AuthCluster\Middleware\AccessControl;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyDashboardAccess
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
        if (env('APP_ENV') === 'testing') {
            return $next($request);
        }

        if ( Auth::guest() || !Auth::user()->can('accessDashboard') ) {
            return \Redirect::route('home');
        }

        return $next($request);
    }
}

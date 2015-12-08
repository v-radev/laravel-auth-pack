<?php namespace App\Clusters\AuthCluster\Middleware\AccessControl;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyUserHasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user();

        if ( !$user || !$user->can($permission) ) {
            abort(401);
            return NULL;
        }

        return $next($request);
    }
}

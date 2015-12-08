<?php namespace App\Clusters\AuthCluster\Middleware\AccessControl;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyUserProfileAccess
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
        $authUser = Auth::user();

        //If no username found from route or username is not auth user
        if (
            !$request->userName || //This is binded in RouteServiceProvider
            $request->userName->username != $authUser->username
        ) {
            if ( !$authUser->can('editUserProfiles') ) {
                return \Redirect::route('profile.edit', $authUser->username);
            }
        }

        return $next($request);
    }
}

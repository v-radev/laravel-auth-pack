<?php namespace App\Clusters\AuthCluster\Traits\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

trait ThrottlesLoginsTrait
{

    protected function hasTooManyLoginAttempts( Request $request )
    {
        $attempts = $this->getLoginAttempts( $request );

        $lockedOut = Cache::has( $this->getLoginLockExpirationKey( $request ) );

        if ( ( $attempts > static::MAX_LOGIN_ATTEMPTS ) || $lockedOut ) {
            if ( !$lockedOut ) {
                $lockoutSeconds = static::LOGIN_LOCKOUT_MINUTES * 60;
                Cache::put( $this->getLoginLockExpirationKey( $request ), time() + $lockoutSeconds, static::LOGIN_LOCKOUT_MINUTES );
            }

            return TRUE;
        }

        return FALSE;
    }

    protected function getLoginAttempts( Request $request )
    {
        return Cache::get( $this->getLoginAttemptsKey( $request ) ) ?: 0;
    }

    protected function incrementLoginAttempts( Request $request )
    {
        $key = $this->getLoginAttemptsKey( $request );

        if ( !Cache::has( $key ) ) {
            Cache::add( $key, 1, static::LOGIN_LOCKOUT_MINUTES );

            return 1;
        }

        return (int)Cache::increment( $key );
    }

    protected function sendLockoutResponse( Request $request )
    {
        $seconds = (int)Cache::get( $this->getLoginLockExpirationKey( $request ) ) - time();

        $message = 'Too many login attempts. Please try again in ' . gmdate( "i:s", $seconds ) . '.';

        return redirect()->route( config( 'authcluster.login_name_space' ) . '.login' )
            ->withInput( $request->only( $this->loginUsername(), 'remember' ) )
            ->withErrors( [
                $this->loginUsername() => $message,
            ] );
    }

    protected function clearLoginAttempts( Request $request )
    {
        Cache::forget( $this->getLoginAttemptsKey( $request ) );

        Cache::forget( $this->getLoginLockExpirationKey( $request ) );
    }

    protected function getLoginAttemptsKey( Request $request )
    {
        $username = $request->input( $this->loginUsername() );

        return 'login:attempts:' . md5( $username . $request->ip() );
    }

    protected function getLoginLockExpirationKey( Request $request )
    {
        $username = $request->input( $this->loginUsername() );

        return 'login:expiration:' . md5( $username . $request->ip() );
    }
}

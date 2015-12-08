<?php namespace App\Clusters\AuthCluster\Traits\User;

use Auth;
use Illuminate\Http\Request;

trait AuthenticatesUsersTrait
{

/********** HTTP **********/

    public function getLogin()
    {
        return view('authcluster.auth.login');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function postLogin( Request $request )
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        //Attempt to login
        if ( Auth::attempt($this->getCredentials($request), $request->has('remember')) ) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }
        else {
            if ( $throttles ) {
                $this->incrementLoginAttempts($request);
            }

            return redirect()->route($this->loginPath())
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
        }
    }

/********** HELPERS **********/

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        return redirect()->intended($this->redirectPath());
    }

    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLoginsTrait::class, class_uses_recursive(get_class($this))
        );
    }

    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
    }

    protected function getFailedLoginMessage()
    {
        return 'Login failed. Please try again.';
    }

    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }

    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

}

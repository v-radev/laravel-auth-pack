<?php namespace App\Clusters\AuthCluster\Traits\User;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Laracasts\Flash\Flash;

trait ResetsPasswordsTrait
{

    public function getEmail()
    {
        return view('authcluster.auth.password');
    }

    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('authcluster.auth.reset')->with('token', $token);
    }

    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                Flash::success('Reset link was successfully sent. Please check your email.');
                return redirect()->back();

            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => 'This e-mail does not exist in our database.']);
        }
    }

    protected function getEmailSubject()
    {
        return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                Flash::success('Password successfully reset. You can now login.');
                return redirect()->route('auth.login');

            default:
                $response = $this->getResponseMessage($response);
                return redirect()->back()
                            ->withInput($request->only('email'))
                            ->withErrors(['email' => $response]);
        }
    }

    protected function resetPassword($user, $password)
    {
        $user->password = $password;

        $user->save();
    }

    protected function getResponseMessage( $response )
    {
        switch ($response) {
            case 'passwords.user':
                $response = 'This is not a valid request for password reset.';
                break;
            case 'passwords.password':
                $response = 'Password must be at least 6 characters.';
                break;
            case 'passwords.token':
                $response = 'Your token or URL for password reset is not valid.';
                break;
            default:
        }

        return $response;
    }

}

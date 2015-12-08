<?php namespace App\Clusters\AuthCluster\Traits\User;

use Auth;
use Illuminate\Http\Request;

trait RegistersUsersTrait
{

    public function getRegister()
    {
        return view('authcluster.auth.register');
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->registerCredentials($request);

        Auth::login($this->create($data));

        return redirect($this->redirectPath());
    }
}

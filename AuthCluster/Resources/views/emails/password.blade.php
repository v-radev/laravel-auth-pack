This is an automatically generated email for password reset from TODO.

Use this link to reset your password: {{ route(config( 'authcluster.login_name_space' ) . '.reset') .'/'. $token }}

Your username for TODO is '{{$user->username}}'.
If you need some assistance or have any problems, please contant the website administrators.

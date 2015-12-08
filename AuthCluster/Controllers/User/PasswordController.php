<?php namespace App\Clusters\AuthCluster\Controllers\User;

use App\Clusters\AuthCluster\Controllers\DefaultController;
use App\Clusters\AuthCluster\Traits\User\ResetsPasswordsTrait;

class PasswordController extends DefaultController {


	use ResetsPasswordsTrait;


    public $subject = 'App - Password Reset Link';


	public function __construct()
	{
        parent::__construct();

		$this->middleware('only.guests');
	}

}

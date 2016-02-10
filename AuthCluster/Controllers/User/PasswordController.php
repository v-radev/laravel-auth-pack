<?php namespace App\Clusters\AuthCluster\Controllers\User;

use App\Clusters\AuthCluster\Controllers\MasterController;
use App\Clusters\AuthCluster\Traits\User\ResetsPasswordsTrait;

class PasswordController extends MasterController
{


    use ResetsPasswordsTrait;


    public $subject = 'App - Password Reset Link';


    public function __construct()
    {
        parent::__construct();

        $this->middleware( 'only.guests' );
    }

}

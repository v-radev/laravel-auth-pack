<?php namespace App\Clusters\AuthCluster\Controllers;

use App\Http\Controllers\Controller;

abstract class MasterController extends Controller
{


    public $currentUser = NULL;

    public $routesNamespace = '';

    public $viewsNamespace = '';


    public function __construct()
    {
        $this->currentUser = \Auth::user();

        \View::share( 'currentUser', $this->currentUser );

        $this->routesNamespace = config( 'authcluster.login_name_space' ) . '.';
        $this->viewsNamespace = config( 'authcluster.views_name_space' ) . '::';
    }


    protected function redirectPath()
    {
        return property_exists( $this, 'redirectPath' ) ? $this->redirectPath : '/';
    }
}

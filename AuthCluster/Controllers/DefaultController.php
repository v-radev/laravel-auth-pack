<?php namespace App\Clusters\AuthCluster\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class DefaultController extends Controller {


    public $currentUser = NULL;


    public function __construct()
    {
        $this->currentUser = \Auth::user();

        \View::share('currentUser', $this->currentUser);
    }


    protected function redirectPath()
    {
        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }
}

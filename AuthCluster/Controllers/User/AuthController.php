<?php namespace App\Clusters\AuthCluster\Controllers\User;

use App\Clusters\AuthCluster\Controllers\DefaultController;
use App\Clusters\AuthCluster\Repositories\UserRepository;
use App\Clusters\AuthCluster\Traits\User\AuthenticatesUsersTrait;
use App\Clusters\AuthCluster\Traits\User\RegistersUsersTrait;
use App\Clusters\AuthCluster\Traits\User\ThrottlesLoginsTrait;
use App\Clusters\AuthCluster\Models\User;
use Illuminate\Http\Request;
use Validator;


class AuthController extends DefaultController {


	use AuthenticatesUsersTrait, RegistersUsersTrait, ThrottlesLoginsTrait;


    const MAX_LOGIN_ATTEMPTS = 3;
    const LOGIN_LOCKOUT_MINUTES = 5;


    protected $redirectPath = '/';

    protected $loginPath = 'auth.login';

    /**
     * @var UserRepository
     */
    protected $repo;

    protected $username = 'username';


    public function __construct( UserRepository $repo )
	{
        parent::__construct();

		$this->middleware('only.guests', ['except' => 'getLogout']);

        $this->repo = $repo;
    }


    protected function validator( Request $request )
    {
        $data = $this->registerCredentials($request);

        $validator = Validator::make($data, User::$registerRules);

        return $validator;
    }

    protected function registerCredentials( Request $request )
    {
        return $request->only('name', 'username', 'email', 'password', 'password_confirmation');
    }

    protected function create( array $data )
    {
        return $this->repo->create($data);
    }

}

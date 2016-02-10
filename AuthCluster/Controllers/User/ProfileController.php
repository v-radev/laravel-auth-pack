<?php namespace App\Clusters\AuthCluster\Controllers\User;

use App\Clusters\AuthCluster\Controllers\MasterController;
use App\Clusters\AuthCluster\Repositories\UserRepository;
use App\Clusters\AuthCluster\Models\User;
use Illuminate\Http\Request;

class ProfileController extends MasterController
{


    /**
     * @var UserRepository
     */
    protected $repo;


    public function __construct( UserRepository $repo )
    {
        parent::__construct();

        $this->repo = $repo;

        $this->middleware( 'only.logged' );
        //Verify binded model of user is of the current user
        $this->middleware( 'access.profile', [ 'except' => 'show' ] );
    }


    public function show( User $user )
    {
        return view( $this->viewsNamespace . 'profiles.show', compact( 'user' ) );
    }

    public function edit( User $user )
    {
        return view( $this->viewsNamespace . 'profiles.edit', compact( 'user' ) );
    }

    public function update( User $user, Request $request )
    {
        $this->validate( $request, $user->getUpdateRules() );

        $data = $request->only( 'name', 'email' );

        if ( $request->has( 'password' ) ) {
            $data['password'] = $request->input( 'password' );
        }

        if ( $user->fill( $data )->save() ) {
            \Flash::success( 'Profile successfully updated!' );
        }

        return redirect()->back();
    }

}

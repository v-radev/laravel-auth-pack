<?php namespace App\Clusters\AuthCluster\Controllers\Dashboard;

use App\Clusters\AuthCluster\Controllers\MasterController;
use App\Clusters\AuthCluster\Models\AccessControl\Permission;
use App\Clusters\AuthCluster\Models\AccessControl\Role;
use App\Clusters\AuthCluster\Models\AccessControl\RolePermission;
use App\Clusters\AuthCluster\Models\AccessControl\UserRole;
use App\Clusters\AuthCluster\Models\AccessControl\UserPermission;
use App\Clusters\AuthCluster\Models\User;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class UsersController extends MasterController
{


    public function __construct()
    {
        parent::__construct();

        $this->middleware( 'only.permission:viewUsers', [ 'only' => [ 'index' ] ] );
        $this->middleware( 'only.permission:updateUsersAccess', [ 'only' => [ 'edit', 'update' ] ] );
        $this->middleware( 'only.permission:deleteUsers', [ 'only' => 'destroy' ] );
    }


    public function index( Request $request )
    {
        $perPage = $request->get( 'perPage' ) ? $request->get( 'perPage' ) : 20;

        //AJAX autocomplete
        if ( $request->ajax() ) {
            $username = $request->get( 'term' );
            if ( $username ) {
                $data = [ ];
                $users = User::username( $username )->take( 10 )->get( [ 'username' ] );
                foreach ( $users as $user ) {
                    $data[] = $user->username;
                }

                return $data;
            }

            return [ ];
        }

        //Check for username query in URL
        $username = $request->get( 'username' );
        if ( $username && strlen( $username ) > 3 ) {
            $users = User::username( $username )->paginate( $perPage );
            $users->appends( [ 'username' => $username ] );
            goto composeView;
        }

        //Check for role query in URL
        $role = $request->get( 'roleId' );
        if ( $role ) {
            $role = UserRole::where( 'role_id', '=', $role )->get();
            $userIds = [ ];

            foreach ( $role as $r ) {
                $userIds[] = $r->user_id;
            }

            $users = User::whereIn( 'id', $userIds )->paginate( $perPage );
            $users->appends( [ 'roleId' => $role ] );
            goto composeView;
        }

        //Check for permission query in URL
        $permission = $request->get( 'permissionId' );
        if ( $permission ) {
            $permission = UserPermission::where( 'permission_id', '=', $permission )->get();
            $userIds = [ ];

            foreach ( $permission as $r ) {
                $userIds[] = $r->user_id;
            }

            $users = User::whereIn( 'id', $userIds )->paginate( $perPage );
            $users->appends( [ 'permissionId' => $permission ] );
            goto composeView;
        }

        //TODO to get the role of each user there is a separate query, this is not cool
        $users = User::paginate( $perPage );

        composeView:
        $permissions = Permission::orderBy( 'name', 'asc' )->get();
        $permissionsList = Permission::orderBy( 'name', 'asc' )->lists( 'name', 'id' )->all();
        $rolesList = Role::orderBy( 'name', 'asc' )->lists( 'name', 'id' )->all();

        return view( $this->viewsNamespace . 'dashboard.users.index', compact( 'users', 'permissions', 'permissionsList', 'rolesList' ) );
    }

    public function edit( $id )
    {
        $user = User::findOrFail( $id );
        $userPermissionsObj = $user->permissions();
        $userRole = $user->role();
        $roles = Role::orderBy( 'id', 'desc' )->lists( 'name', 'id' )->all();
        $userPermissions = [ ];
        $permissions = [ ];

        if ( $userRole ) {
            $permissions = RolePermission::where( 'role_id', '=', $userRole->id )
                ->with( 'permission' )->get();
        }

        foreach ( $userPermissionsObj as $p ) {
            $userPermissions[] = $p->id;
        }

        return view( $this->viewsNamespace . 'dashboard.users.edit', compact( 'user', 'roles', 'userPermissions', 'userRole', 'permissions' ) );
    }

    public function update( $id )
    {
        $user = User::findOrFail( $id );
        $data = \Input::only( [ 'user_permissions', 'user_role' ] );
        $currentRoleId = $user->role() ? $user->role()->id : NULL;

        if ( isset( $data['user_role'] ) && $currentRoleId != $data['user_role'] ) {
            $user->setRole( $data['user_role'] );
        }

        if ( is_array( $data['user_permissions'] ) && !empty( $data['user_permissions'] ) ) {
            $user->permissionsRelation()->delete();//Delete all permissions
            foreach ( $data['user_permissions'] as $permission ) {
                $permission = Permission::findOrFail( $permission );
                if ( $user->attachPermission( $permission->name ) === FALSE ) {
                    Flash::error( 'You are trying to assign a disabled permission to this role!' );
                    goto redirect;
                }
            }
        }

        Flash::success( 'User data successfully updated!' );
        redirect:

        return redirect()->back();
    }

    public function destroy( $id )
    {
        $user = User::findOrFail( $id );
        $userRolePermissions = $user->permissionsRelation();
        $userRole = $user->roleRelation();
        $msg = 'User successfully deleted';

        if ( $userRolePermissions && $userRolePermissions->delete() ) {
            $msg .= ', with user permissions';
        }
        if ( $userRole && $userRole->delete() ) {
            $msg .= ', with user role';
        }

        if ( !$user->delete() ) {
            Flash::error( 'There was and error deleting the user!' );
        }

        Flash::success( $msg . '.' );

        return redirect()->back();
    }
}

<?php namespace App\Clusters\AuthCluster\Repositories;

use App\Clusters\AuthCluster\Models\AccessControl\Permission;
use App\Clusters\AuthCluster\Models\AccessControl\Role;
use App\Clusters\AuthCluster\Models\AccessControl\UserRole;
use App\Clusters\AuthCluster\Models\AccessControl\UserPermission;
use App\Clusters\AuthCluster\Models\User;

class UserRepository extends Repository
{

    /**
     * @var User
     */
    protected $model;

    protected $usersTable;

    protected $permissionsTable;

    protected $userPermissionTable;

    protected $rolesTable;

    protected $userRoleTable;


    public function __construct( User $model )
    {
        $this->model = $model;

        $this->usersTable = User::$tableName;
        $this->permissionsTable = Permission::$tableName;
        $this->userPermissionTable = UserPermission::$tableName;
        $this->rolesTable = Role::$tableName;
        $this->userRoleTable = UserRole::$tableName;
    }


    public function create( array $data )
    {
        $user = $this->model->create( $data );
        $permissions = Permission::$defaultPermissions;

        $user->setRole( Role::$defaultRole );

        foreach ( $permissions as $permission ) {
            $user->attachPermission( $permission );
        }

        return $user;
    }

    public function getPermissions( $id )
    {
        $UT = $this->usersTable;
        $PT = $this->permissionsTable;
        $UPT = $this->userPermissionTable;

        return \DB::table( $UT )
            ->where( $UT . '.id', '=', $id )
            ->join( $UPT, $UT . '.id', '=', $UPT . '.user_id' )
            ->join( $PT, $UPT . '.permission_id', '=', $PT . '.id' )
            ->select( $PT . '.id', $PT . '.name' )
            ->orderBy( $PT . '.name', 'asc' )
            ->get();
    }

    public function getRole( $id )
    {
        $UT = $this->usersTable;
        $RT = $this->rolesTable;
        $URT = $this->userRoleTable;

        $data = \DB::table( $UT )
            ->where( $UT . '.id', '=', $id )
            ->join( $URT, $UT . '.id', '=', $URT . '.user_id' )
            ->join( $RT, $URT . '.role_id', '=', $RT . '.id' )
            ->select( $RT . '.id', $RT . '.name' )
            ->get();

        return array_shift( $data );
    }
}
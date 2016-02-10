<?php namespace App\Clusters\AuthCluster\Resources\Database\Seeds;

use App\Clusters\AuthCluster\Repositories\RolePermissionRepository;
use Illuminate\Database\Seeder;


class RolesPermissionsTableSeeder extends Seeder
{

    /**
     * @var RolePermissionRepository
     */
    protected $rolePermissionRepo;


    public function __construct( RolePermissionRepository $rolePermissionRepo )
    {
        $this->rolePermissionRepo = $rolePermissionRepo;
    }


    public function run()
    {
        \DB::table( 'role_permission' )->truncate();

        foreach ( $this->rolePermissionRepo->getSeeds() as $rolePermission ) {
            \App\Clusters\AuthCluster\Models\AccessControl\RolePermission::create( $rolePermission );
        }
    }
}

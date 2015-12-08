<?php namespace App\Clusters\AuthCluster\Repositories\Seeds;

use App\Clusters\AuthCluster\Models\AccessControl\Permission;
use App\Clusters\AuthCluster\Models\AccessControl\Role;

class RolePermissionSeedRepository extends SeedRepository {


    protected $_tableName = 'roles_permissions';


    public function getSeeds( $role )
    {
        return $this->seedDataGetter($role);
    }

    public function getAdminSeeds()
    {
        return $this->seedDataGetter('admin');
    }

    public function getModeratorSeeds()
    {
        return $this->seedDataGetter('moderator');
    }

    public function getUserSeeds()
    {
        return $this->seedDataGetter('user');
    }

    protected function seedDataGetter( $seedName )
    {
        $seedName = strtolower($seedName);
        $role = Role::where('name', '=', $seedName)->firstOrFail();
        $permissions = [];
        $data = [];

        foreach ( $this->seedFilesIterator( DIRECTORY_SEPARATOR. $seedName ) as $line ) {
            $extraData = ['role_id' => $role->id];
            $permissions[] = $this->seedDataComposer($line, $extraData);
        }

        foreach ( $permissions as $permission ) {
            $permissionId = Permission::where('name', '=', $permission['name'])->firstOrFail()->id;
            $data[] = [
                    'role_id'       => $permission['role_id'],
                    'permission_id' => $permissionId,
                ];
        }

        return $data;
    }

}
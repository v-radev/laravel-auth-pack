<?php namespace App\Clusters\AuthCluster\Traits\User;

use App\Clusters\AuthCluster\Models\AccessControl\Permission;
use App\Clusters\AuthCluster\Models\AccessControl\Role;
use App\Clusters\AuthCluster\Models\AccessControl\RolePermission;
use App\Clusters\AuthCluster\Models\AccessControl\UserRole;
use Cache;

trait ControlsUserAccessTrait
{

    public function is( $role )
    {
        return $this->role()->name == $role;
    }

    public function can( $permission )
    {
        $cacheKey = $this->getPermissionsCacheKey();

        if ( is_array( $permission ) ) {
            foreach ( $permission as $right ) {
                if ( !$this->can( $right ) ) return FALSE;
            }

            return TRUE;
        }

        $permissions = Cache::remember( $cacheKey, 20, function () {
            return $this->permissions();
        } );

        foreach ( $permissions as $p ) {
            if ( $p->name == $permission ) return TRUE;
        }

        return FALSE;
    }

    public function setRole( $role )
    {
        $cacheKey = $this->getPermissionsCacheKey();

        if ( is_numeric( $role ) ) {
            $role = Role::findOrFail( $role );
            goto modelSave;
        }

        $role = Role::where( 'name', '=', $role )->firstOrFail();

        modelSave:
        $this->permissionsRelation()->delete();//Delete all permissions
        Cache::forget( $cacheKey );

        $authUsername = \Auth::user() ? \Auth::user()->username : 'AUTO';
        \Log::info( 'SET: Role of "' . $role->name . '" to user "' . $this->username . '" by user "' . $authUsername . '".' );

        if ( !$this->roleRelation ) {
            $userRole = new UserRole( [ 'user_id' => $this->id, 'role_id' => $role->id ] );
            $this->roleRelation()->save( $userRole );

            return;
        }

        $this->roleRelation->role_id = $role->id;
        $this->roleRelation->save();
    }

    public function attachPermission( $permission )
    {
        $cacheKey = $this->getPermissionsCacheKey();
        $permission = Permission::where( 'name', '=', $permission )->firstOrFail();
        $rolePermission = RolePermission::where( 'role_id', '=', $this->role()->id )
            ->where( 'permission_id', '=', $permission->id )
            ->first();

        //This role does not support this permission
        if ( !$rolePermission ) return FALSE;

        $record = $this->permissionsRelation()->where( 'permission_id', '=', $permission->id )
            ->where( 'user_id', '=', $this->id )
            ->first();
        if ( $record ) return NULL;//User already has permission

        $authUsername = \Auth::user() ? \Auth::user()->username : 'AUTO';
        \Log::info( 'SET: Permission "' . $permission . '" to user "' . $this->username . '" by user "' . $authUsername . '".' );

        $this->permissionsRelation()->create( [
            'user_id'       => $this->id,
            'permission_id' => $permission->id
        ] );
        Cache::forget( $cacheKey );

        return TRUE;
    }

    public function detachPermission( $permission )
    {
        $cacheKey = $this->getPermissionsCacheKey();
        $permission = Permission::where( 'name', '=', $permission )->firstOrFail();

        $record = $this->permissionsRelation()->where( 'permission_id', '=', $permission->id )
            ->where( 'user_id', '=', $this->id )
            ->first();
        if ( $record ) {
            $record->delete();
            Cache::forget( $cacheKey );
        }
    }

    protected function getPermissionsCacheKey()
    {
        return 'permissions_' . $this->username;
    }
}

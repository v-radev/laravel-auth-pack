<?php namespace App\Clusters\AuthCluster\Models\AccessControl;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{

    protected $table = 'role_permission';

    protected $fillable = [ 'role_id', 'permission_id' ];


    public function permission()
    {
        return $this->hasOne( 'App\Clusters\AuthCluster\Models\AccessControl\Permission', 'id', 'permission_id' );
    }
}

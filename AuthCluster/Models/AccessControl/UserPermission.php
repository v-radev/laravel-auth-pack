<?php namespace App\Clusters\AuthCluster\Models\AccessControl;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{

    protected $table = 'user_permission';

    protected $fillable = ['user_id', 'permission_id'];

    public static $tableName = 'user_permission';

}

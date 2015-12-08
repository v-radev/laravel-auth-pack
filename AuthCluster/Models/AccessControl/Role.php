<?php namespace App\Clusters\AuthCluster\Models\AccessControl;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'roles';

    public static $tableName = 'roles';

    public static $defaultRole = 'user';

}

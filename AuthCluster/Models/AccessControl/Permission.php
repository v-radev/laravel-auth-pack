<?php namespace App\Clusters\AuthCluster\Models\AccessControl;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    public $timestamps = FALSE;

    protected $table = 'permissions';

    public static $tableName = 'permissions';

    public static $defaultPermissions = [ 'browseWebsite' ];

}

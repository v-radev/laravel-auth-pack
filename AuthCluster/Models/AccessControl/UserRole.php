<?php namespace App\Clusters\AuthCluster\Models\AccessControl;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    protected $table = 'user_role';

    protected $fillable = [ 'user_id', 'role_id' ];

    public static $tableName = 'user_role';

}

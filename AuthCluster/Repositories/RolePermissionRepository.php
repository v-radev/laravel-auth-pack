<?php namespace App\Clusters\AuthCluster\Repositories;

use App\Clusters\AuthCluster\Models\AccessControl\RolePermission;

class RolePermissionRepository extends Repository
{

    /**
     * @var RolePermissionRepository
     */
    protected $model;

    protected $_roleSeeds = ['admin', 'moderator', 'user'];


    public function __construct( RolePermission $model )
    {
        $this->model = $model;
    }


    public function getSeeds()
    {
        $rolePermSeed = \App::make('App\Clusters\AuthCluster\Repositories\Seeds\RolePermissionSeedRepository');
        $seeds = [];

        foreach ( $this->_roleSeeds as $role ) {
            $seedMethod = 'get'. ucfirst($role) .'Seeds';
            $seeds = array_merge($seeds, $rolePermSeed->$seedMethod());
        }

        return $seeds;
    }
}
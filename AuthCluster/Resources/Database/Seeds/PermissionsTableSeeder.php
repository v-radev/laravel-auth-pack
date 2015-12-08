<?php namespace App\Clusters\AuthCluster\Resources\Database\Seeds;

use Illuminate\Database\Seeder;


class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('permissions')->truncate();

        $generalPermissions = [
            ['name' => 'editUserProfiles'],
            ['name' => 'browseWebsite'],
        ];

        $dashboardPermissions = [
            ['name' => 'accessDashboard'],
        //USERS MANAGEMENT
            ['name' => 'viewUsers'],
            ['name' => 'updateUsersAccess'],
            ['name' => 'deleteUsers'],
        ];

        $permissions = array_merge($generalPermissions, $dashboardPermissions);

        foreach ( $permissions as $permission ) {
            \App\Clusters\AuthCluster\Models\AccessControl\Permission::create($permission);
        }
    }
}

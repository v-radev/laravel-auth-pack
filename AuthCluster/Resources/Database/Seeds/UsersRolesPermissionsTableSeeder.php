<?php namespace App\Clusters\AuthCluster\Resources\Database\Seeds;

use Illuminate\Database\Seeder;


class UsersRolesPermissionsTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('user_permission')->truncate();

        $adminUserID = \App\Clusters\AuthCluster\Models\User::where('username', '=', 'admin')->firstOrFail()->id;

        $usersRolesPermissions = [
            [
                'user_id' => $adminUserID,
                'permission_id' => '1'
            ],
            [
                'user_id' => $adminUserID,
                'permission_id' => '2'
            ],
            [
                'user_id' => $adminUserID,
                'permission_id' => '3'
            ]
        ];

        foreach ( $usersRolesPermissions as $permission ) {
            \App\Clusters\AuthCluster\Models\AccessControl\UserPermission::create($permission);
        }
    }
}

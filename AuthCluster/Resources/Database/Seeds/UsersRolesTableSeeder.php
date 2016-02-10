<?php namespace App\Clusters\AuthCluster\Resources\Database\Seeds;

use Illuminate\Database\Seeder;


class UsersRolesTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table( 'user_role' )->truncate();

        $usersRoles = [
            [
                'user_id' => \App\Clusters\AuthCluster\Models\User::where( 'username', '=', 'admin' )->firstOrFail()->id,
                'role_id' => \App\Clusters\AuthCluster\Models\AccessControl\Role::where( 'name', '=', 'admin' )->firstOrFail()->id
            ],
            [
                'user_id' => \App\Clusters\AuthCluster\Models\User::where( 'username', '=', 'user' )->firstOrFail()->id,
                'role_id' => \App\Clusters\AuthCluster\Models\AccessControl\Role::where( 'name', '=', 'user' )->firstOrFail()->id
            ]
        ];

        foreach ( $usersRoles as $permission ) {
            \App\Clusters\AuthCluster\Models\AccessControl\UserRole::create( $permission );
        }
    }
}

<?php namespace App\Clusters\AuthCluster\Resources\Database\Seeds;

use Illuminate\Database\Seeder;


class RolesTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('roles')->truncate();

        $roles = [
            ['name' => 'admin', 'display' => 'Administrator'],
            ['name' => 'moderator', 'display' => 'Moderator'],
            ['name' => 'user', 'display' => 'User'],
        ];

        foreach ( $roles as $role ) {
            \App\Clusters\AuthCluster\Models\AccessControl\Role::create($role);
        }
    }
}

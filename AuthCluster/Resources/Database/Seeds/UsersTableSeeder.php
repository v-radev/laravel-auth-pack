<?php namespace App\Clusters\AuthCluster\Resources\Database\Seeds;

use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('users')->truncate();

        $users = [
            [
                'username' => 'user',
                'email'    => 'email@example.com',
                'password' => 'dW596q5X4FF72ER'
            ],
            [
                'username' => 'admin',
                'email'    => 'admin@example.com',
                'password' => 'XB7pGnTZq64434s'
            ],
            [
                'username' => 'admins',
                'email'    => 'admins@example.com',
                'password' => 'R34kf259U54kd9X'
            ],
            [
                'username' => 'administrator',
                'email'    => 'administrator@example.com',
                'password' => '99937G2x2J26rCa'
            ],
            [
                'username' => 'moderator',
                'email'    => 'moderator@example.com',
                'password' => '5z3Xu7Gq9t49kNs'
            ],
            [
                'username' => 'mods',
                'email'    => 'mods@example.com',
                'password' => '4G8465QH8y4t28b'
            ],
        ];

        $repo = \App::make('\App\Clusters\AuthCluster\Repositories\UserRepository');
        
        foreach ( $users as $user ) {
            $repo->create($user);
        }

    }
}

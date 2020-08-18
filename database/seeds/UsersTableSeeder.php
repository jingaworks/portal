<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin Name',
                'email'              => 'admin@mail.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2020-08-16 06:46:06',
                'verification_token' => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'Manager name',
                'email'              => 'manager@mail.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2020-08-16 06:46:06',
                'verification_token' => '',
            ],
            [
                'id'                 => 3,
                'name'               => 'User name',
                'email'              => 'user@mail.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2020-08-16 06:46:06',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
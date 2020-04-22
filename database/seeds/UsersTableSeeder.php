<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'              => 'Admin',
                'email'             => 'admin@admin.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password'          => app('hash')->make('password'),
                'role'              => 'admin',
                'created_at'        => date('Y-m-d H:i:s'),
                'status'            => 1
            ]
        ];
        User::insert($data);
    }
}

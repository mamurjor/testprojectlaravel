<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::Create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('11111111'),
            'role'      => 'admin'
        ]);

           User::Create([
            'name'      => 'manager',
            'email'     => 'manager@gmail.com',
            'password'  => Hash::make('11111111'),
            'role'      => 'manager'
        ]);

          User::Create([
            'name'      => 'agent',
            'email'     => 'agent@gmail.com',
            'password'  => Hash::make('11111111'),
            'role'      => 'agent'
        ]);

          User::Create([
            'name'      => 'user',
            'email'     => 'user@gmail.com',
            'password'  => Hash::make('11111111'),
            'role'      => 'user'
        ]);
             User::Create([
            'name'      => 'member',
            'email'     => 'member@gmail.com',
            'password'  => Hash::make('11111111'),
            'role'      => 'member'
        ]);
    }
}

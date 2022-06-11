<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Guillermo',
                'last_name' => 'hernandez',
                'username' => 'memrade',
                'email' => 'memrade@gmail.com',
                'password' => bcrypt('@dmin123'),
                'role_id' => 1
            ],
            [
                'name' => 'Giovanni',
                'last_name' => 'Tzec',
                'username' => 'tzec',
                'email' => 'tzec@gmail.com',
                'password' => bcrypt('@dmin123'),
                'role_id' => 1
            ],
        ];
        $clients = [
            [
                'name' => 'Ernesto',
                'last_name' => 'Sanchez',
                'username' => 'ernesto',
                'email' => 'ernesto@gmail.com',
                'password' => bcrypt('cli3nt123'),
                'role_id' => 2
            ],
        ];
        $advisers = [
            [
                'name' => 'Josue',
                'last_name' => 'Andrade',
                'username' => 'josue',
                'email' => 'josue@gmail.com',
                'password' => bcrypt('g@to123'),
                'role_id' => 3
            ],
            [
                'name' => 'Jose',
                'last_name' => 'Sanchez',
                'username' => 'jose',
                'email' => 'jose@gmail.com',
                'password' => bcrypt('@dviser123'),
                'role_id' => 3
            ],
        ];
        foreach ($admins as $user) {
            $user = User::create($user);
            $user->assignRole('Administrator');
        }
        foreach ($clients as $user) {
            $user = User::create($user);
            $user->assignRole('Client');
        }
        foreach ($advisers as $user) {
            $user = User::create($user);
            $user->assignRole('Adviser');
        }
    }
}

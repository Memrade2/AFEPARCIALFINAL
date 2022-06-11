<?php

namespace Database\Seeders;

use App\Models\Administrator;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
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
                'administrator_name' => 'Guillermo Hernandez',
                'dui' => '01021117-2',
                'phone' => '22222222',
                'user_id' => '1'
            ],
            [
                'administrator_name' => 'Giovanni Tzec',
                'dui' => '03214678-0',
                'phone' => '22222222',
                'user_id' => '2'
            ],
            [
                'administrator_name' => 'Jose Sanchez',
                'dui' => '05267670-3',
                'phone' => '77777777',
                'user_id' => '3'
            ],
            [
                'administrator_name' => 'administrador',
                'dui' => '00000234-0',
                'phone' => '22222222',
                'user_id' => '4'
            ],
            
        ];

        foreach ($admins as $admin) {
            $admin = Administrator::create($admin);
        }
    }
}

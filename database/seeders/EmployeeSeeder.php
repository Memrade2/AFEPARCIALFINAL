<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [
            [
                'employee_name' => 'Guillermo Hernandez',
                'age'=>25,
                'base_salary'=>850.00,
                'address'=> 'San Salvador',
                'photo'=> 'foto.png',
                'administrator_id'=>'1',
                'subsidiary_id'=>'1'
            ],
            [
                'employee_name' => 'Giovanni Tzec',
                'age'=>29,
                'base_salary'=>1050.00,
                'address'=> 'San Salvador',
                'photo'=> 'foto.png',
                'administrator_id'=>'1',
                'subsidiary_id'=>'1'
            ],
            [
                'employee_name' => 'Jose Sanchez',
                'age'=>27,
                'base_salary'=>750.00,
                'address'=> 'San Salvador',
                'photo'=> 'foto.png',
                'administrator_id'=>'1',
                'subsidiary_id'=>'1'
            ],
            [
                'employee_name' => 'administrador',
                'age'=>24,
                'base_salary'=>450.00,
                'address'=> 'San Salvador',
                'photo'=> 'foto.png',
                'administrator_id'=>'1',
                'subsidiary_id'=>'1'
            ],
            
        ];

        foreach ($employee as $empl) {
            $empl = Employee::create($empl);
        }
    }
}

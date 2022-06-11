<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subsidiary;

class SubsidiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subsidiary = [
            [
                'subsidiary_name' => 'Guillermo Hernandez'
            ],
            [
                'subsidiary_name' => 'Giovanni Tzec'
            ],
            [
                'subsidiary_name' => 'Jose Sanchez'
            ],
            [
                'subsidiary_name' => 'administrador'
            ],
            
        ];

        foreach ($subsidiary as $subs) {
            $subs = Subsidiary::create($subs);
        }
    }
}

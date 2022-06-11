<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sellers = [
            [
                'dui' => '00000000-9',
                'address' => 'Luces altas',
                'nit' => '0000-250600-000-0',
                'user_id' => 1
            ],
            [
                'dui' => '00000000-8',
                'address' => 'Luces',
                'nit' => '0000-120800-000-0',
                'user_id' => 2
            ],
            [
                'dui' => '00000000-7',
                'address' => 'altas',
                'nit' => '0000-000600-000-0',
                'user_id' => 3
            ],
            [
                'dui' => '00000000-6',
                'address' => 'Lucetas',
                'nit' => '0000-250001-000-0',
                'user_id' => 4
            ],
            
        ];

        foreach ($sellers as $seller) {
            Seller::create($seller);
        }
    }
}

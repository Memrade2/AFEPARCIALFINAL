<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'product_name' => 'Product A',
                'description' => 'Luces altas',
                'unitary_price' => 23.5,
                'stocks' => 100,
                'garanty' => '1 año',
                'seller_id' => 1
            ],
            [
                'product_name' => 'A Product',
                'description' => 'altas',
                'unitary_price' => 1.5,
                'stocks' => 100,
                'garanty' => '5 año',
                'seller_id' => 2
            ],
            [
                'product_name' => 'Pro A',
                'description' => 'Luctas',
                'unitary_price' => 5,
                'stocks' => 100,
                'garanty' => '6 meses',
                'seller_id' => 3
            ],
            [
                'product_name' => 'duct A',
                'description' => 'Laltas',
                'unitary_price' => 0.5,
                'stocks' => 100,
                'garanty' => '1 año',
                'seller_id' => 4
            ],
            
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

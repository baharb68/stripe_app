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
                'name' => 'Business Plan',
                'slug' => 'business-plan',
                'stripe_id' => 'price_1MFKt1LmoZb4zh0v3qPlqiQM',
                'price' => 20,
                'description' => 'Business Plan',
            ],[
                'name' => 'Premium',
                'slug' => 'premium',
                'stripe_id' => 'price_1MFKryLmoZb4zh0veIku6Dzj',
                'price' => 40,
                'description' => 'Premium',
            ]
        ];

        foreach($products as $product){
            Product::create($product);
        }
    }
}

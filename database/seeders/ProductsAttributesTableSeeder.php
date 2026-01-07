<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsAttributes;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecords = [
            ['id'=>1, 'product_id'=>1, 'size'=>'Small', 'price'=>1200, 'stock'=>10, 'sku'=>'BT001-S', 'status'=>1],
            ['id'=>2, 'product_id'=>1, 'size'=>'Small', 'price'=>1200, 'stock'=>10, 'sku'=>'BT001-S', 'status'=>1],
        ];
        ProductsAttributes::insert($productAttributesRecords);
    }
}

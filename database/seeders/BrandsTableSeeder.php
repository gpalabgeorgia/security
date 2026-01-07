<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
            ['id'=>1, 'name'=>'Test', 'status'=>1],
            ['id'=>2, 'name'=>'Test2', 'status'=>1],
            ['id'=>3, 'name'=>'Test3', 'status'=>1],
        ];
        Brand::insert($brandRecords);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionsRecords = [
            ['id'=>1, 'name'=>'Home', 'status'=>1],
            ['id'=>2, 'name'=>'Shop', 'status'=>1],
            ['id'=>3, 'name'=>'Pages', 'status'=>1],
            ['id'=>4, 'name'=>'Blog', 'status'=>1],
            ['id'=>5, 'name'=>'Contact', 'status'=>1],
        ];
        Section::insert($sectionsRecords);
    }
}

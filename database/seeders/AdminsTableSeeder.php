<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
            ['id'=>1, 'name'=>'admin', 'type'=>'admin', 'mobile'=>'654567765', 'email'=>'admin@admin.com', 'password'=>'$2y$10$6C2pC7NHsv/j9gsOZsdntOMfin6gDQTKdmg6sM8CqQb6/n3w/gLLu', 'image'=>'', 'status'=>1]
        ];
        DB::table('admins')->insert($adminRecords);
//        foreach($adminRecords as $key => $record) {
//            \App\Models\Admin::create($record);
//        }
    }
}

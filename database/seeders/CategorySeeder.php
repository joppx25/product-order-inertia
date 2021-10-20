<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'rattan',
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ], 
            [
                'name' => 'buri',
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ], 
            [
                'name' => 'nito',
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}

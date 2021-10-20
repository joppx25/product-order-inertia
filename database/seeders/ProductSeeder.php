<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Rectangular Tray',
                'description' => 'Lorem ipsum dolor set',
                'category_id' => 1,
                'price' => 100,
                'quantity' => 5,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Oval Organizer',
                'description' => 'Lorem ipsum dolor set',
                'category_id' => 2,
                'price' => 20,
                'quantity' => 6,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Placemat',
                'description' => 'Lorem ipsum dolor set',
                'category_id' => 3,
                'price' => 15,
                'quantity' => 4,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Hamper',
                'description' => 'Lorem ipsum dolor set',
                'category_id' => 1,
                'price' => 150,
                'quantity' => 50,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Regina chair',
                'description' => 'Lorem ipsum dolor set',
                'category_id' => 2,
                'price' => 1000,
                'quantity' => 1,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ],
        ];

        DB::table('products')->insert($data);
    }
}

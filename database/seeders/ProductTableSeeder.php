<?php

namespace Database\Seeders;

use App\Models\Product_M;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product_M::factory(5)->create();

        //Custom
//        Product_M::create([
//
//        ]);
    }
}

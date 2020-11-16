<?php

namespace Database\Seeders;

use App\Models\Product_M;
use Database\Factories\Product_MFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Method 1
        Product_M::factory(10)->create();
        /*
        method 2: this method forces us to create a table seeder the one above is shorter.
         That being said, in a table seeder you can create custom entries as well as factory ones.
         Without a table seed you can't add custom entries.
        */
//        $this->call(ProductTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}

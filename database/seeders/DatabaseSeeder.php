<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
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
         User::factory(3)->create();


         $this->call([
            CategorySeeder::class,
            ServerSeeder::class,
        ]);

         Product::factory(1)->create();

         $this->call([
             PlanSeeder::class,
             DiscountSeeder::class
         ]);

    }
}

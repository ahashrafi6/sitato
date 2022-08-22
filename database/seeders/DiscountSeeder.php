<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::insert(
            [
                ['user_id' => 2 , 'title' => 'تخفیف 30% تست', 'code' => 'code_30', 'discount' => 30, 'capacity' => 3 , 'capacity_per_user' => 2, 'type' => 'cash', 'start_at' => now(), 'expire_at' => now()->addDays(2)],
                ['user_id' => 2 , 'title' => 'تخفیف 50% تست', 'code' => 'code_50', 'discount' => 50, 'capacity' => 3 , 'capacity_per_user' => 2, 'type' => 'cash', 'start_at' => now(), 'expire_at' => now()->addDays(2)],
                ['user_id' => 2 , 'title' => 'تخفیف 50% اشتراک', 'code' => 'sub_50', 'discount' => 50, 'capacity' => 3 , 'capacity_per_user' => null, 'type' => 'subscribe', 'start_at' => now(), 'expire_at' => now()->addDays(2)],
            ]
        );
    }
}

<?php

namespace Database\Seeders;
;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::insert(
            [
                ['product_id' => 1, 'fa_title' => 'پایه', 'en_title' => 'base', 'description' => 'امکانات پایه اسکریپت لرناتو,دسترسی مادام العمر به محصول و آپدیت ها,۳ ماه پشتیبانی رایگان (قابل تمدید),بازگشت وجه در صورت وجود هرگونه مشکل فنی', 'body' => 'تست', 'status' => 'published', 'price' => 1500000, 'support' => 3,
                 'sale' => 0, 'isOff' => 1,'offPrice' => 750000,'capacity' => 1,'consumed' => 1,'start_at' => null,'expire_at' => null,],

                 ['product_id' => 1, 'fa_title' => 'پرو', 'en_title' => 'pro', 'description' => 'امکانات پایه اسکریپت لرناتو,+ امکانات پیشرفته,6 ماه پشتیبانی رایگان (قابل تمدید),دسترسی مادام العمر به محصول و آپدیت ها,بازگشت وجه در صورت وجود هرگونه مشکل فنی', 'body' => 'تست', 'status' => 'published', 'price' => 2900000, 'support' => 6,
                 'sale' => 0, 'isOff' => 1,'offPrice' => 1500000,'capacity' => 1,'consumed' => 1,'start_at' => null,'expire_at' => null,],
            ]
        );
    }
}

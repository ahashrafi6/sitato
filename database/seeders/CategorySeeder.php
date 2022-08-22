<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert(
           [
               [ 'fa_title' => 'سیستم اختصاصی', 'en_title' => 'script', 'body' => 'این محتوا جهت تست است.'],
               [ 'fa_title' => 'وردپرس', 'en_title' => 'wordpress', 'body' => 'این محتوا جهت تست است.'],

           ]
        );
    }
}

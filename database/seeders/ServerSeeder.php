<?php

namespace Database\Seeders;

use App\Models\Server;
use Illuminate\Database\Seeder;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Server::insert([
            ['fa_title' => 'پایه', 'en_title' => 'ir-small', 'region' => 'iran',  'server_id' => 'ir-small','database_id' => 'ir-mini', 'price' => 135000,
               'isSpecial' => false,
                'server' => 'RAM: 512MB , CPU: 0.5 Core , فضای ذخیره سازی:‌ 5 GB SSD , فضای پشتیبان: 50 GB HDD  , ترافیک: نامحدود ,',
                'database' => 'RAM: 256MB , CPU: 0.25 Core , فضای ذخیره سازی:‌ 2.5 GB SSD , فضای پشتیبان: 25 GB HDD  , ترافیک: نامحدود ,',
                'sum' => 'RAM: 768MB , CPU: 0.75 Core'],

               ['fa_title' => 'استارت‌آپ', 'en_title' => 'ir-medium', 'region' => 'iran',  'server_id' => 'ir-medium','database_id' => 'ir-small', 'price' => 270000,
               'isSpecial' => false,
               'server' => 'RAM: 1 GB , CPU: 1 Core , فضای ذخیره سازی:‌ 10 GB SSD , فضای پشتیبان: 100 GB HDD  , ترافیک: نامحدود ,',
               'database' => 'RAM: 512MB , CPU: 0.5 Core , فضای ذخیره سازی:‌ 5 GB SSD , فضای پشتیبان: 50 GB HDD  , ترافیک: نامحدود ,',
               'sum' => 'RAM: 1.512 GB , CPU: 1.50 Core'],

               ['fa_title' => 'رشد', 'en_title' => 'ir-standard', 'region' => 'iran',  'server_id' => 'ir-standard','database_id' => 'ir-medium', 'price' => 490000,
               'isSpecial' => true,
               'server' => 'RAM: 2 GB , CPU: 2 Core , فضای ذخیره سازی:‌ 20 GB SSD , فضای پشتیبان: 200 GB HDD  , ترافیک: نامحدود ,',
               'database' => 'RAM: 1 GB , CPU: 1 Core , فضای ذخیره سازی:‌ 10 GB SSD , فضای پشتیبان: 100 GB HDD  , ترافیک: نامحدود ,',
               'sum' => 'RAM: 3 GB , CPU: 3 Core'],

               ['fa_title' => 'کسب و کار', 'en_title' => 'ir-standard-2x', 'region' => 'iran',  'server_id' => 'ir-standard-2x','database_id' => 'ir-standard', 'price' => 950000,
               'isSpecial' => false,
               'server' => 'RAM: 4 GB , CPU: 4 Core , فضای ذخیره سازی:‌ 40 GB SSD , فضای پشتیبان: 400 GB HDD  , ترافیک: نامحدود ,',
               'database' => 'RAM: 2 GB , CPU: 2 Core , فضای ذخیره سازی:‌ 20 GB SSD , فضای پشتیبان: 200 GB HDD  , ترافیک: نامحدود ,',
               'sum' => 'RAM: 6 GB , CPU: 6 Core'],

               ['fa_title' => 'پرو', 'en_title' => 'ir-large-2x', 'region' => 'iran',  'server_id' => 'ir-large-2x','database_id' => 'ir-standard-2x', 'price' => 1950000,
               'isSpecial' => false,
               'server' => 'RAM: 8 GB , CPU: 8 Core , فضای ذخیره سازی:‌ 80 GB SSD , فضای پشتیبان: 800 GB HDD  , ترافیک: نامحدود ,',
               'database' => 'RAM: 4 GB , CPU: 4 Core , فضای ذخیره سازی:‌ 40 GB SSD , فضای پشتیبان: 400 GB HDD  , ترافیک: نامحدود ,',
               'sum' => 'RAM: 12 GB , CPU: 12 Core'],

               ['fa_title' => 'الماس', 'en_title' => 'ir-large-3x', 'region' => 'iran',  'server_id' => 'ir-large-3x','database_id' => 'ir-large-2x', 'price' => 3850000,
               'isSpecial' => false,
               'server' => 'RAM: 16 GB , CPU: 16 Core , فضای ذخیره سازی:‌ 160 GB SSD , فضای پشتیبان: 1600 GB HDD  , ترافیک: نامحدود ,',
               'database' => 'RAM: 8 GB , CPU: 8 Core , فضای ذخیره سازی:‌ 80 GB SSD , فضای پشتیبان: 800 GB HDD  , ترافیک: نامحدود ,',
               'sum' => 'RAM: 24 GB , CPU: 24 Core'],
               
        ]);
    }
}

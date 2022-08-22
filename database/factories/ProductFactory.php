<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => 1,
            'fa_title' =>  'پلتفرم جامع آموزشی لرناتو',
            'en_title' => 'learnato lms',
            'description' => 'لرناتو اولین پلتفرم آموزشی ایران با امکانات کامل و بی نظیر',
            'body' => 'لرناتو اولین پلتفرم آموزشی ایران با امکانات کامل و بی نظیر',
            'status' => 'published',
            'isSpecial' => rand(0, 1),
            'version' => '1.0.2',
            'icon' => 'images/products/default/woodmart-icon.png',
            'cover' => 'images/products/default/woodmart.jpg',

        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            'user_id' => 1,
            'author_id' => 2,
            'zone_id' => 1,
            'fa_title' => $name,
            'fa_display' => $name,
            'en_title' => $name,
            'en_display' => $name,
            'description' => $this->faker->paragraph,
            'body' => $this->faker->randomHtml(3),
            'status' => 'published',
            'isSpecial' => rand(0, 1),
            'access' => array_rand(['cash' => 'cash', 'subscribe' => 'subscribe', 'full' => 'full'], 1),
            'price' => array_rand([129000 => 129000, 299000 => 299000, 79000 => 79000], 1),
            'income_percent' => 50,
            'cover' => 'images/products/default/woodmart.jpg',
            'cover2' => 'images/products/default/woodmart.jpg',
            'mini_cover' => 'images/products/default/woodmart.jpg',
        ];
    }
}

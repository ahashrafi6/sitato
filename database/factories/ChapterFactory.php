<?php

namespace Database\Factories;

use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChapterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chapter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            'course_id' => rand(1, 9),
            'fa_title' => $name,
            'en_title' => $name,
            'description' => $this->faker->paragraph,
            'body' => $this->faker->randomHtml(3),
            'status' => 'published',
            'type' => $this->faker->randomElement(['free', 'subscribe','cash']),
            'display' => $this->faker->randomElement(['chapter' , 'quiz']),
            'video' => 'http://google.com',
            'file' => 'http://google.com',
            'release_at' => now(),
            'minute' => rand(5 , 59),
            'second' => rand(5 , 59),
        ];
    }
}

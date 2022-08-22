<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

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
            'category_id' => 1,
            'fa_title' => $name,
            'fa_display' => $name,
            'en_title' => $name,
            'description' => $this->faker->paragraph,
            'body' => $this->faker->randomHtml(3),
            'status' => 'published',
            'cover' => 'images/articles/default/article-default.png',
        ];
    }
}

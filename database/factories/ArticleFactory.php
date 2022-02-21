<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use Illuminate\Support\Str;

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
        return [
            'user_id' => rand(1, 10),
            'title' => $this->faker->sentence(),
            'slug' => Str::slug($this->faker->sentence(), '-'),
            'thumbnail' => '1645452144.jpg',
            'visibility' => 'public',
            'categories_id' => '1',
            'article' => $this->faker->paragraphs(100, true),
        ];
    }
}
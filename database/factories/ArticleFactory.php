<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;
    
    public function definition()
    {
        return [
            'code' => $this->faker->phoneNumber,
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'text' => $this->faker->text(),
            'datePublished' => now(),
            'owner_id' => '',
        ];
    }
}

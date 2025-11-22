<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence();

        return [
            'title'         => $title,
            'slug'          => Str::slug($title) . '-' . Str::random(5),
            'content'       => $this->faker->paragraph(5),
            'author_id'     => 1,   // أدمن
            'published'     => true,
            'published_at'  => now(),
        ];
    }
}

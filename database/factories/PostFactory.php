<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class PostFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'       => fake()->title(),
            'description' => fake()->text(),
            'link'        => fake()->url(),
            'source'      => Post::SOURCE_VNEXPRESS,
            'content'     => fake()->paragraph(),
            'score_time'  => fake()->numberBetween(800, 1000),
            'score_click' => fake()->numberBetween(100, 300),
            'score_like'  => fake()->numberBetween(100, 300),
            'score_hot'   => fake()->numberBetween(100, 300),
            'is_new'      => true,
        ];
    }
}

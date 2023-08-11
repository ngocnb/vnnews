<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\UserPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class UserPostFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $post = Post::factory()->create();
        $data = [
            'user_id'          => User::factory(),
            'post_id'          => $post->id,
            'total_post_score' => fake()->numberBetween(500, 1500),
            'total_tag_score'  => fake()->numberBetween(500, 1500),
            'post_title'       => $post->title,
            'reaction'         => fake()->randomElement([
                UserPost::REACTION_LIKE,
                UserPost::REACTION_HATE,
                UserPost::NO_REACTION,
            ]),
        ];
        $data['total_score'] = $data['total_post_score'] + $data['total_tag_score'];

        return $data;
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
 public function definition(): array {
$title = fake()->sentence(6);
return [
'user_id' => 1,
'title' => $title,
'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1000,9999),
'excerpt' => fake()->paragraph(),
'content' => fake()->paragraphs(5, true),
'status' => 'published',
'published_at' => now()->subDays(rand(0, 365)),
];
}
}

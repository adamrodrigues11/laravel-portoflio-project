<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bodyArray = fake()->paragraphs(3);
        $body = '<p>' . join('</p><p>', $bodyArray) . '</p>';
        $title = fake()->company() . ' ' . fake()->companySuffix();
        return [
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'excerpt' => fake()->catchPhrase(),
            'body' => $body,
        ];
    }
}

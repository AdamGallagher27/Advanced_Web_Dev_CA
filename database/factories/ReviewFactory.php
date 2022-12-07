<?php

namespace Database\Factories;
use App\Models\Movie;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Production>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->word,
            "description" => $this->faker->text(50),
            "rating" => $this->faker->text(10),
            "user_id" => 3,
            "movie_id" => $this->faker->randomElement(Movie::pluck("id"))
        ];
    }
}
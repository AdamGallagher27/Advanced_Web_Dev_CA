<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Facades\DB;




/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */



    public function definition()
    {
        return [
            // creates fake data for database
            "title" => $this->faker->word,
            // "director" => $this->faker->name,
            "description" => $this->faker->text(50),

            // faker->image() does not work
            // "image" => $this->faker->image('public/storage/images',350,500, true, true),
            
            // faker->imageUrl() works but sends links to db not image path
            "image" => $this->faker->imageUrl(350,500, "movie"),

            "budget" => $this->faker->numberBetween(1000000, 10000000),
            "box_office" => $this->faker->numberBetween(1000000, 10000000),
            'user_id' => $this->faker->randomElement(User::pluck("id"))

        ];
    }
}

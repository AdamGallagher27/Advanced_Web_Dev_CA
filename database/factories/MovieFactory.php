<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Facades\DB;

// // work around for creating random foreign keys
// $users = User::all();
// $userCount = $users->count();


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

    // public function getUser() {
    //     // work around for creating random foreign keys
    //     $users = User::all();
    //     return $users->count();
    // }


    public function definition()
    {
        return [
            // creates fake data for database
            "title" => $this->faker->word,
            "director" => $this->faker->name,
            "description" => $this->faker->text(50),
            "image" => $this->faker->word,
            "budget" => $this->faker->numberBetween(1000000, 10000000),
            "box office" => $this->faker->numberBetween(1000000, 10000000),
            // gets random user id for foreign key
            // 'user_id' => $this->faker->numberBetween(1, getUser()),

        ];
    }
}

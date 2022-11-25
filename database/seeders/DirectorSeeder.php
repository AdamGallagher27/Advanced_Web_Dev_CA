<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Director::factory()->times(5)->create();

        foreach(Movie::all() as $movie)
        {
            $directors = Director::inRandomOrder()->take(rand(1, 5))->pluck("id");
            $movie->directors()->attach($directors);
        }
    }
}

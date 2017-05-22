<?php

use Illuminate\Database\Seeder;
use \MovieCollection\Models\Movie;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Movie::class, 50)->create()->each(function ($movie) {
            $movie->save();
        });
    }
}

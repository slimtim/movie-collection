<?php

use MovieCollection\Models\Movie;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Movie::class, function (Faker\Generator $faker) {
    return [
        'title' => ucwords($faker->unique()->words(rand(1,5), true)),
        'actors' => call_user_func(function () use ($faker) {
            $actors = [];
            // Generate one or many actor names
            foreach (range(1, rand(1, 5)) as $i) {
                $actors[] = $faker->firstName . ' ' . $faker->lastName; 
            }
            return join(', ', $actors);
        }),
        'rating' => $faker->optional()->randomElement(range(1.0, 5.0, 0.5)),
        'genre' => $faker->randomElement([
            'Action', 'Adventure', 'Animation', 'Comedy', 'Crime', 'Documentary',
            'Drama', 'Fantasy', 'History', 'Horror', 'Musical', 'Mystery', 'Romance',
            'Sci-Fi', 'Sport', 'Thriller'
        ]),        
    ];
});

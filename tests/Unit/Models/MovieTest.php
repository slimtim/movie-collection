<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use MovieCollection\Models\Movie;

class MovieTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Tests saving a new movie
     */
    public function testCreateMovie()
    {
        $movie = factory(Movie::class)->create();
        
        $this->assertInstanceOf(Movie::class, $movie);
    }
    
    /**
     * Tests setting the movie rating
     *
     * @param $rating
     * @param $expectedRating
     *
     * @dataProvider ratingProvider
     */
    public function testSetRating($rating, $expectedRating)
    {
        $movie = new Movie();
        
        $movie->rating = $rating;
        $this->assertSame($expectedRating, $movie->rating);
    }

    /**
     * Data provider for ratings
     * 
     * @return array
     */
    public function ratingProvider()
    {
        return [
            [1.5, 1.5],
            ['3.0', 3.0],
            ['', null],
            ['foobar', null],            
        ];
    }
    
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use MovieCollection\Models\Movie;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Test the movies controller
 * 
 * @package Tests\Feature
 */
class MoviesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Movie $movie
     */
    protected $movie;

    /**
     * Setup the test environment
     */
    public function setUp()
    {
        parent::setUp();
        
        // Adds a movie to storage
        $this->movie = factory(Movie::class)->create();
    }

    /**
     * Tests listing the movies
     */
    public function testListMovies()
    {
        $response = $this->get('/movies');

        $response->assertStatus(200)
            ->assertSee(e($this->movie->title))
            ->assertSee(e($this->movie->genre))
            ->assertSee(e($this->movie->actors))
            ->assertSee($this->movie->path());
    }

    /**
     * Tests showing the details of a movie
     */
    public function testShowMovie()
    {
        $response = $this->get($this->movie->path());

        $response->assertStatus(200)
            ->assertSee(e($this->movie->title))
            ->assertSee(e($this->movie->genre))
            ->assertSee(e($this->movie->actors));
    }

    /**
     * Tests showing the details of a movie that does not exist
     */
    public function testShowMovieNotFound()
    {
        $response = $this->get('/movies/0');

        $response->assertStatus(404);
    }
    
    /**
     * Tests adding a movie
     */
    public function testAddMovie()
    {
        $movie = factory(Movie::class)->make();

        $response = $this->post('/movies', [
            'title' => $movie->title,
            'genre' => $movie->genre,
            'actors' => $movie->actors,
            'rating' => $movie->rating,
        ]);

        $response->assertStatus(302)
            ->assertSessionHas('message', 'Your movie was added');

        $this->assertDatabaseHas('movies', [
            'title' => $movie->title,
            'genre' => $movie->genre,
            'actors' => $movie->actors,
        ]);
    }

    /**
     * Tests adding a movie with no input values
     */
    public function testAddMovieWithNoInput()
    {
        $response = $this->post('/movies', []);
        
        $response->assertSessionHasErrors(['title' => 'The title field is required.']);
    }

    /**
     * Tests adding a movie that already exists
     */
    public function testAddDuplicateMovie()
    {
        $response = $this->post('/movies', [
            'title' => $this->movie->title,
            'genre' => $this->movie->genre,
            'actors' => $this->movie->actors,
        ]);

        $response->assertSessionHasErrors([
            'title' => 'A movie with this title, genre, and actors already exists'
        ]);
    }

    /**
     * Tests editing a movie
     */
    public function testEditMovie()
    {
        // The original, unedited movie
        $movie = factory(Movie::class)->create();
        
        // The updates to make to the movie
        $movieChanges = factory(Movie::class)->make();        
        
        $response = $this->patch($movie->path(), [
            'title' => $movieChanges->title,
            'genre' => $movieChanges->genre,
            'actors' => $movieChanges->actors,
            'rating' => $movieChanges->rating,
        ]);

        $response->assertStatus(302)
            ->assertSessionHas('message', 'Your movie was updated');

        $this->assertDatabaseHas('movies', [
            'id' => $movie->id,
            'title' => $movieChanges->title,
            'genre' => $movieChanges->genre,
            'actors' => $movieChanges->actors,
        ]);
    }
    
    /**
     * Tests deleting a movie
     */
    public function testDeleteMovie()
    {
        $movie = factory(Movie::class)->create();
        
        $this->assertDatabaseHas('movies', ['id' => $movie->id]);
        
        $response = $this->delete($movie->path());

        $response->assertStatus(302)
            ->assertSessionHas('message', 'Your movie was deleted');
        
        $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
    }
}

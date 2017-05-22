<?php

namespace MovieCollection\Http\Controllers;

use MovieCollection\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();

        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create', ['movie' => new Movie()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules($request));
        
        $movie = Movie::create($request->all());
        
        return redirect($movie->path())->with('message', 'Your movie was added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \MovieCollection\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MovieCollection\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MovieCollection\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $this->validate($request, $this->validationRules($request, $movie->id));
        
        $movie->update($request->all());
        
        return redirect($movie->path())->with('message', 'Your movie was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MovieCollection\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect('/movies')->with('message', 'Your movie was deleted');
    }

    /**
     * Validation rules for the movies form
     * 
     * @param Request $request 
     * @param int $movieId ID of movie being validated (null if adding a movie)
     * @return array Form validation rules
     */
    protected function validationRules(Request $request, $movieId = null)
    {
        // Force the title + genre + actors combo to be unique
        $noDupes = Rule::unique('movies')->where(function ($query) use ($request, $movieId) {
            $query->where('genre', $request->get('genre'))
                ->where('actors', $request->get('actors'))
                ->where('id', '!=', (int) $movieId);
        });
        
        return [
            'title'   => ['bail', 'required', 'max:200', $noDupes],
            'genre'   => 'max:50',
            'actors'  => 'max:1000',
            'rating'  => ['nullable', 'regex:/^([1-4](\.[05])?|5(\.0)?)$/'],
        ];
    }
}

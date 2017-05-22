@extends('layouts.master')

@section('content')

    <h1 class="text-center">Movie Collection</h1>

    @if (count($movies) > 0)
        @include('movies.movies_list');
    @else
        <p>Your movie collection is empty. Why don't you <a href="/movies/create">add a movie</a>.</p>
    @endif
    
@stop



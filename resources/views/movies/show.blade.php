@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>{{ $movie->title }}</h1>
        </div>
        <div class="panel-body">
            @if ($movie->rating)
                <p><span class="star-rating rating-{{ intval($movie->rating * 10) }}"></span></p>
            @endif

            <p>
                <strong>Genre: </strong>
                {{ $movie->genre }}
            </p>

            <p>
                <strong>Actors: </strong>
                {{ $movie->actors }}
            </p>
        </div>        
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-6">
                    <a class="btn btn-primary" href="{{ $movie->path() }}/edit" role="button">Edit</a>
                </div>
                <div class="col-sm-6 text-right">
                    <form action="{{ $movie->path() }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this movie?');">
                        
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a class="btn btn-default" href="/movies" role="button">Return to my movies</a>

@stop

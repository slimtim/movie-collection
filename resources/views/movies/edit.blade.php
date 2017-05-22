@extends ('layouts.master')

@section ('content')
    <h1 class="text-center">Edit Movie</h1>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ $movie->path() }}" class="form-horizontal">
        {{ method_field('PATCH') }}

        @include ('movies.form')
    </form>
@stop
@extends ('layouts.master')

@section ('content')
    <h1 class="text-center">Add a Movie</h1>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="/movies" class="form-horizontal">
        @include ('movies.form')
    </form>
@stop

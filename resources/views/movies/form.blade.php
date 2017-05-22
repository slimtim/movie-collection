{{ csrf_field() }}

<div class="form-group">
    <label for="title" class="col-sm-2 control-label">Title:</label>
    <div class="col-xs-10">
        <input type="text" name="title" id="title" class="form-control" 
               value="{{ old('title', $movie->title) }}">
    </div>
</div>

<div class="form-group">
    <label for="genre" class="col-sm-2 control-label">Genre:</label>
    <div class="col-xs-10">
        <input type="text" name="genre" id="genre" class="form-control"
               value="{{ old('genre', $movie->genre) }}">
    </div>
</div>

<div class="form-group">
    <label for="actors" class="col-sm-2 control-label">Actors:</label>
    <div class="col-xs-10">
        <input type="text" name="actors" id="actors" class="form-control"
               value="{{ old('actors', $movie->actors) }}">
    </div>
</div>

<div class="form-group">
    <label for="rating" class="col-sm-2 control-label">Rating:</label>
    <div class="col-xs-10">
        <select name="rating">
            <option value=""></option>
        @foreach (range(1.0, 5.0, 0.5) as $value)
            <option value="{{ $value }}" {{ $value == old('rating', $movie->rating) ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>

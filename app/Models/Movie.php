<?php

namespace MovieCollection\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'genre', 'actors', 'rating'];

    /**
     * Set the movie rating
     * 
     * @param mixed $value Rating
     * @return void
     */
    public function setRatingAttribute($value)
    {
        $this->attributes['rating'] = is_numeric($value) ? (float) $value : null;
    }

    /**
     * Get the URL path of the movie
     * 
     * @return string 
     */
    public function path()
    {
        return "/movies/" . $this->id;
    }
    
}

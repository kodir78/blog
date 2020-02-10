<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $dates    = ['published_at'];
    
    // Relasi users ke posts
    public function author()
    {
        return $this->belongsTo(User::class);
    }
    public function getImageUrlAttribute($value)
    {
       //
    $image_url = "";

    if ( ! is_null($this->image))
    {
        //$directory = config('cms.image.directory');
        $imagePath = public_path() . "/img/" . $this->image;
        if (file_exists($imagePath)) $image_url = asset("img/" . $this->image);
    }

    return $image_url;
    }

    public function getDateAttribute($value)
    {
        //return $this->created_at->diffForHumans();
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
    
    public function scopePublished($query)
    {
         return $query->where("published_at", "<=", Carbon::now());
    }
}

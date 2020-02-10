<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
        return $this->created_at->diffForHumans();
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'Asc');
    }
    
}

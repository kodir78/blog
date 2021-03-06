<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Post;

class Post extends Model
{
    protected $dates    = ['published_at'];
    
    // Relasi users ke posts
    public function author()
    {
        return $this->belongsTo(User::class);
    }
    // Relasi Category ke Post
    public function category()
    {
        # code...
        return $this->belongsTo(Category::class);
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

     public function getImageThumbUrlAttribute($value)
    {
       //
        $image_url = "";

        if ( ! is_null($this->image))
        {
            $ext        = substr(strchr($this->image, '.'), 1);
            $thumbnail  = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath  = public_path() . "/img/" . $thumbnail;
            if (file_exists($imagePath)) $image_url = asset("img/" . $thumbnail);
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
    
     public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public function scopePublished($query)
    {
       return $query->where("published_at", "<=", Carbon::now());
   }

   // SEO 
   public function getRouteKeyName()
   {
    return 'slug';
    }
    
    public function dateFormatted($showTimes = false)
    {
        $format = "d/m/Y";
        if ($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {
        if ( ! $this->published_at) {
            return '<span class="badge badge-warning">Draft</span>';
        }
        elseif ($this->published_at && $this->published_at->isFuture()) {
            return '<span class="badge badge-info">Schedule</span>';
        }
        else {
            return '<span class="badge badge-success">Published</span>';
        }
    }
 }

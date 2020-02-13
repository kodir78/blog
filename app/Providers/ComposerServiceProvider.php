<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Post;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // inisilisasi kode relevan dan sering dipanggil
        view()->composer('layouts.sidebar', function($view){
             $categories = Category::with(['posts' => function($query) {$query->published();
        }])->orderBy('title','asc')->get(); 
            return $view->with('categories', $categories);
        });

        view()->composer('layouts.sidebar', function($view){
             $popularPost = Post::published()->popular()->take(3)->get(); 
            return $view->with('popularPost', $popularPost);
        });

    }
}

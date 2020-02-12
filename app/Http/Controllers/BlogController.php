<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    protected $limit = 3;
    public function index()
    {
        $categories = Category::with(['posts' => function($query) {$query->published();
        }])->orderBy('title','asc')->get();
        $posts = Post::with('author')
        ->latestFirst()
		->published()
        ->paginate($this->limit);
        return view("blog.index", compact('posts', 'categories'));
    }
    public function category($id)
    {
        $categories = Category::with(['posts' => function($query) {$query->published();
        }])->orderBy('title','asc')->get();
        $posts = Post::with('author')
        ->latestFirst()
        ->published()
        ->where('category_id', $id)
        ->paginate($this->limit);
        return view("blog.index", compact('posts', 'categories'));
    }
    public function show(Post $post)
    {
    	//die("ini show");
    	//$post = Post::findOrFail($slug);
    	return view('blog/show', compact('post'));
    }
}

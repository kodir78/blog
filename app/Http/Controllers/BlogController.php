<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    protected $limit = 3;
    public function index()
    {
        
        $posts = Post::with('author')
        ->latestFirst()
		->published()
        ->paginate($this->limit);
        return view("blog.index", compact('posts'));
    }

    public function show($id)
    {
    	//die("ini show");
    	$post = Post::findOrFail($id);
    	return view('blog/show', compact('post'));
    }
}

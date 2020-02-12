<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;

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
    public function category(Category $category)
    {
        $categoryName = $category->title;

        $posts = $category->posts()
                            ->latestFirst()
                            ->with('author')
                            ->published()
                            ->paginate($this->limit);

        return view("blog.index", compact('posts', 'categoryName'));
    }

    public function author(User $author)
    {
        # code...
        $authorName = $author->name;

        $posts = $author->posts()
                            ->latestFirst()
                            ->with('category')
                            ->published()
                            ->paginate($this->limit);

        return view("blog.index", compact('posts', 'authorName'));
    }

    public function show(Post $post)
    {
    	//die("ini show");
    	//$post = Post::findOrFail($slug);
    	return view('blog/show', compact('post'));
    }
}

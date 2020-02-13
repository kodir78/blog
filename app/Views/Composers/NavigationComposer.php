<?php 
	namespace App\Views\Composers;

	use Illuminate\View\View;
	use App\Category;
	use App\Post;

	/**
	 * 
	 */
	class NavigationComposer
	{
		
		public function compose(View $view)
		{
			# code...
			$this->composeCategories($view);
			
			$this->composePopularPost($view);

		}

		public function composeCategories(View $view)
		{
			# code...
			
             $categories = Category::with(['posts' => function($query) {$query->published();
        		}])->orderBy('title','asc')->get(); 
            $view->with('categories', $categories);
		}

		public function composePopularPost(View $view)
		{
			# code...
			$popularPost = Post::published()->popular()->take(3)->get(); 
            return $view->with('popularPost', $popularPost);
		}

	}

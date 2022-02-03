<?php

namespace App\Http\Controllers\EndUser;

use App\models\Tag;
use App\models\Post;
use App\models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index($slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        $category_posts = $category->posts()->orderBy('id', 'DESC')->paginate(10);

        $popular = Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())
                        ->orderBy('views', 'DESC')->take(5)->get();

        $top_categories =  Category::withCount('posts')
                                   ->orderBy('posts_count', 'DESC')->take(10)->get();

        $top_tags =  Tag::withCount('posts')
                        ->orderBy('posts_count', 'DESC')->take(10)->get();

        return view('enduser/category' ,compact(['category_posts','category','popular','top_categories','top_tags']));
    }

    public function categories(){
        $title = "الاقسام";
        $categories = Category::withCount('posts')
                                ->having('posts_count', '>', 1)
                                ->orderBy('id', 'DESC')->paginate(10);
    
        $popular = Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())
                        ->orderBy('views', 'DESC')->take(5)->get();

        $top_categories =  Category::withCount('posts')
                                   ->orderBy('posts_count', 'DESC')->take(10)->get();

        $top_tags =  Tag::withCount('posts')
                        ->orderBy('posts_count', 'DESC')->take(10)->get();

        return view('enduser/categories' ,compact(['title','categories','popular','top_categories','top_tags']));
    }
}

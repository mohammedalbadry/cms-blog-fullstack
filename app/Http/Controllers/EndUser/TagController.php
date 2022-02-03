<?php

namespace App\Http\Controllers\EndUser;

use App\models\Tag;
use App\models\Post;
use App\models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index($slug){
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $tag_posts = $tag->posts()->orderBy('id', 'DESC')->paginate(10);

        $popular = Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())
                        ->orderBy('views', 'DESC')->take(5)->get();

        $top_categories =  Category::withCount('posts')
                                   ->orderBy('posts_count', 'DESC')->take(10)->get();

        $top_tags =  Tag::withCount('posts')
                        ->orderBy('posts_count', 'DESC')->take(10)->get();
                        
        return view('enduser/tag' ,compact(['tag_posts','tag','popular','top_categories','top_tags']));
    }

    public function tags(){
        $title = "الوسوم";
        $tags = Tag::withCount('posts')
                   ->having('posts_count', '>', 1)
                   ->orderBy('id', 'DESC')->paginate(10);

        $popular = Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())
                        ->orderBy('views', 'DESC')->take(5)->get();

        $top_categories =  Category::withCount('posts')
                                   ->orderBy('posts_count', 'DESC')->take(10)->get();

        $top_tags =  Tag::withCount('posts')
                        ->orderBy('posts_count', 'DESC')->take(10)->get();
                        
        return view('enduser/tags' ,compact(['title','tags','popular','top_categories','top_tags']));
    }
}

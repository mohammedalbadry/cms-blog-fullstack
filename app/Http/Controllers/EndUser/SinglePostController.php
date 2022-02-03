<?php

namespace App\Http\Controllers\EndUser;

use Share;
use App\models\Tag;
use App\models\Post;
use App\models\Category;
use Illuminate\Http\Request;
use App\Models\ViewsCounters;
use App\Http\Controllers\Controller;

class SinglePostController extends Controller
{
    public function index($slug){

        $post = Post::where('slug', $slug)->firstOrFail();

        $postCategoriesIds = $post->categories->pluck('id');

        $related_posts = Post::whereHas('categories', function($q) use ($postCategoriesIds) {
            $q->whereIn('category_id', $postCategoriesIds);
        })->orderBy('id', 'DESC')->take(6)->get();

        $top_categories =  Category::withCount('posts')
                                    ->orderBy('posts_count', 'DESC')->take(6)->get();

        $top_tags =  Tag::withCount('posts')
                        ->orderBy('posts_count', 'DESC')->take(6)->get();

        $shere = Share::currentPage()
                        ->facebook()
                        ->twitter()
                        ->whatsapp()
                        ->Telegram()->getRawLinks();

        
                        

        $this->ViewsCounter('post', $post->id);
        return view('enduser/single-post' ,compact(['post', 'related_posts', 'top_categories', 'top_tags', 'shere']));
    }


    public function ViewsCounter($name, $id = null){

        $today = ViewsCounters::where('view_name', $name)
                              ->where('post_id', $id)
                              ->where('created_at', '>=', date('Y-m-d').' 00:00:00');

        if($today->count() == 0){
            ViewsCounters::create([
                'post_id' => $id,
                'view_name' => $name,
                'views' => 1,
            ]);
        }else{
            $data = $today->latest()->first();
            $data->update([
                'views' => $data->views + 1
            ]);
        }
    }
}

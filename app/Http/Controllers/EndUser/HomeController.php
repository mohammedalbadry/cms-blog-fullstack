<?php

namespace App\Http\Controllers\EndUser;

use App\models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request){

        if($request->month && $request->year){
            $ArchiveFunction = $this->archive($request);
            return $ArchiveFunction;

        }

        if($request->search){
            $SearchFunction = $this->search($request);
            return $SearchFunction;
        }
        $title = "الرئيسية";
        $posts = Post::orderBy('id', 'DESC')->take(4)->get();
        $popular = Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())
                        ->orderBy('views', 'DESC')->take(5)->get();
       
        $top_categories =  Category::withCount('posts')
                        ->orderBy('posts_count', 'DESC')->take(10)->get();
                
        $top_tags =  Tag::withCount('posts')
                        ->orderBy('posts_count', 'DESC')->take(10)->get();

        $categories = Category::where('parent_id', 0)
                                ->withCount('posts')
                                ->having('posts_count', '>', 3)
                                ->withCount('children')
                                ->having('children_count', '>=', 0)
                                ->orderBy('posts_count', 'DESC')->take(3)->get();

        $sub_categories = [];
        $article = Post::whereHas('categories', function($q) {
            $q->where('name', "اخبار");
        })->orderBy('id', 'DESC')->take(6)->get();



        foreach($categories as $catigory){
            $sub_category = $catigory::where('parent_id', $catigory->id)
                        ->withCount('posts')
                        ->having('posts_count', '>', 3)
                        ->orderBy('posts_count', 'DESC')->take(4)->get();

                        $sub_categories[] = $sub_category;
       
        }
        /*
        foreach($categories as $i=>$category){
            echo $category->name . " - القسم - " . $i;
            echo "<br>";
            foreach($category->posts->take(4)  as $item){
                echo $item->title . " - المنشور - " . $i;
                echo "<br>";
            }
            foreach($sub_categories[$i] as $child){
                echo $child->name  . " - القسم الفرعي - " . $i;
                echo "<br>";
                foreach($child->posts->take(4) as $item){
                    echo $item->title . " - المنشور من القسم الفرعي - " . $i;
                    echo "<br>";
                }
            }
        }
       */
        return view('enduser/home' ,compact(['title', 'posts', 'popular', 'categories', 'sub_categories', 'article','top_categories', 'top_tags']));
    }

    public function search(Request $request){
        $title = $request->search;
        $posts =  Post::where('title', 'like', '%' . $request->search . '%')
                      ->orderBy('id', 'DESC')->paginate(10);

        $popular = Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())
                      ->orderBy('views', 'DESC')->take(5)->get();

        $top_categories =  Category::withCount('posts')
                                    ->orderBy('posts_count', 'DESC')->take(10)->get();

        $top_tags =  Tag::withCount('posts')
                        ->orderBy('posts_count', 'DESC')->take(10)->get();

        return view('enduser/search' ,compact(['title', 'posts','popular','top_categories','top_tags']));
    }

    public function archive(Request $request){

        $title = "الارشيف";
        $posts =  Post::whereMonth('created_at', $request->month)
                      ->whereYear('created_at', $request->year)
                      ->orderBy('id', 'DESC')
                      ->paginate(10);
        
        $popular = Post::whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth())
                        ->orderBy('views', 'DESC')->take(5)->get();

        $top_categories =  Category::withCount('posts')
                                    ->orderBy('posts_count', 'DESC')->take(10)->get();

        $top_tags =  Tag::withCount('posts')
                        ->orderBy('posts_count', 'DESC')->take(10)->get();

        return view('enduser/search' ,compact(['title', 'posts','popular','top_categories','top_tags']));
    }

}

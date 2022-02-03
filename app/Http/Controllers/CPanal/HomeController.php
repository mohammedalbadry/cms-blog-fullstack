<?php

namespace App\Http\Controllers\CPanal;

use DB;
use App\models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\ViewsCounters;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){

        $visitor_statistics = ViewsCounters::select(
            DB::raw('DAY(created_at) as day'),
            DB::raw('SUM(views) as views')
        )->groupBy('day')->orderBy('created_at', 'desc')->take(15)->get();
        

        $title = "الرئيسية";
        $users = User::count();
        $posts = Post::count();
        $comments = Comment::count();
        $reports = Report::count();

        $visitos_days=[];
        foreach($visitor_statistics as $one){
            $visitos_days[] .= $one->day ;
        }
        $visitos_views=[];
        foreach($visitor_statistics as $one){
            $visitos_views[] .= $one->views ;
        }

        return view('cpanal/home',compact(['title','users','posts','comments','reports',
                                           'visitos_days', 'visitos_views']));
    }
}

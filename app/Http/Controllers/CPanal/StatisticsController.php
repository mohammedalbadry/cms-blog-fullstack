<?php

namespace App\Http\Controllers\CPanal;

use Illuminate\Http\Request;
use App\Models\ViewsCounters;
use DB;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
  
    public function index()
    {
        $data = ViewsCounters::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('DAY(created_at) as day'),
            DB::raw('SUM(views) as views')
        )
        ->groupBy('day')
        ->groupBy('month')
        ->orderBy('created_at', 'desc')->paginate(30);
       // dd($data);
        $title = "الاحصائيات";
        return view('cpanal.statistics.index',compact(['data', 'title']));
    }

}

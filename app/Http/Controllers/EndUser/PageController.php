<?php

namespace App\Http\Controllers\EndUser;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(){
        $page = Page::where('slug', request()->path())->first();
        return view('enduser/page' ,compact(['page']));
    }
}

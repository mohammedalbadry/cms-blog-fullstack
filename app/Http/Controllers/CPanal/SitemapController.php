<?php

namespace App\Http\Controllers\CPanal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index(){
        $title = 'فهرسة المواقع';
        return view('cpanal.sitemap', compact('title'));
    }

    public function generat(){

        $path = public_path('sitemap.xml');
        SitemapGenerator::create('http://localhost:8000/cmsapp/public')->writeToFile($path);
        session()->flash('success', 'تم فهرسة التدوينات بنجاح');
        return back();
    }

    public function download(){

        $file = public_path('sitemap.xml');

        $headers = ['Content-Type: text/xm'];

        return Response::download($file, 'sitemap.xml', $headers);

    }
}

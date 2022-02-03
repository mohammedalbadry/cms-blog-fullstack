<?php

namespace App\Providers;

use App\models\Post;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $setting = Setting::first();
        $archives = Post::selectRaw('year(created_at) year, month(created_at) month, count(id) count')
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->take(5)
                ->get();

        $popular_article  = post::orderBy('views', 'DESC')->take(3)->get();
        View::share(['setting' => $setting, 'archives' => $archives, 'popular_article' => $popular_article]);
        
    }
}

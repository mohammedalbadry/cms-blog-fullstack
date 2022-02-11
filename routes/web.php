<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['prefix' => 'admin', 'namespace'=> 'CPanal'], function(){

    /* admin auth */
    Route::get('login', 'AdminAuthController@login');
    Route::post('login', 'AdminAuthController@doLogin');

    Route::get('forgot_password', 'AdminAuthController@ForgotPassword');
    Route::post('forgot_password', 'AdminAuthController@DoForgotPassword');

    Route::get('reset_password/{token}', 'AdminAuthController@ResetPassword');
    Route::post('reset_password/{token}', 'AdminAuthController@DoResetPassword');

    Route::any('logout', 'AdminAuthController@Logout'); 

});




Route::group(['prefix' => 'admin', 'namespace'=> 'CPanal', 'middleware' => 'idadmin:admin'], function(){

    Route::get('sitemap', 'SitemapController@index');
    Route::get('generat', 'SitemapController@generat');
    Route::get('download', 'SitemapController@download');


    
    Route::get('/markAsRead', function(){
        $admin = Admin()->user();
        $admin->unreadNotifications->markAsRead();
    });

    Route::get('/', 'HomeController@index');
    Route::get('media-view', 'MediaController@index');
    
    Route::get('setting', 'SettingController@index');
    Route::post('setting', 'SettingController@update');

    Route::get('users', 'UserController@index');
    Route::post('users/{id}', 'UserController@block');

    Route::get('comments', 'CommentController@index');
    Route::delete('comments/{id}', 'CommentController@delete');

    Route::get('contacts', 'ContactController@index');
    Route::delete('contacts/{id}', 'ContactController@delete'); 

    Route::get('reports', 'ReportController@index');
    Route::post('reports/{id}', 'ReportController@result');

    Route::get('statistics', 'StatisticsController@index');

    Route::resource('admins', 'AdminController')->except(['show']);
    Route::resource('tags', 'TagController')->except(['show']);
    Route::resource('categories', 'CategoryController')->except(['show']);
    Route::resource('posts', 'PostController')->except(['show']);
    Route::resource('pages', 'PageController')->except(['show','create']);

    Route::group(['prefix' => 'images-media', 'middleware' => 'idadmin:admin'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
   
}); 

Auth::routes();
Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');


Route::get('close', function () {
    if(App\Models\Setting::first()->status == 'close'){
        return view('enduser.close');
    }
    return redirect('/');
    
});

Route::group(['namespace'=> 'EndUser', 'middleware' => 'settingcheck'], function(){

    Route::get('/', 'HomeController@index');
    Route::get('contact', 'ContactController@index');
    Route::post('contact', 'ContactController@store');

    Route::get('about', 'PageController@index');
    Route::get('policy', 'PageController@index');    
    Route::get('tags', 'TagController@tags');
    Route::get('tag/{slug}', 'TagController@index');
    Route::get('categories', 'CategoryController@categories');
    Route::get('category/{slug}', 'CategoryController@index');
    
    Route::group(['middleware' => 'auth:web'], function(){
        Route::resource('comment', 'CommentController')->except(['index', 'show','create','edit']);
        Route::post('report', 'ReportController@index');
        Route::get('profile', 'ProfileController@index');
        Route::post('profile', 'ProfileController@update');
        Route::get('/markAsRead', function(){
            $user =  auth()->user();
            $user->unreadNotifications->markAsRead();
        });
    }); 

    Route::get('{slug}', 'SinglePostController@index');


});



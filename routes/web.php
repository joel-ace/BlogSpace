<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.admin');
});

Route::group(['prefix' => 'admin'], function() {

    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'article'], function() {

        Route::get('/new', [
            'uses' => 'ArticleController@createArticlePage',
            'as' => 'create-articles'
        ]);

        Route::get('/manage', [
            'uses' => 'ArticleController@listArticles',
            'as' => 'manage-articles'
        ]);

        Route::get('/edit/{id}', [
            'uses' => 'ArticleController@editArticlePage',
            'as' => 'edit-article'
        ]);

        Route::get('/delete/{id}', [
            'uses' => 'ArticleController@deleteArticle',
            'as' => 'delete-article'
        ]);

    });

//
//    Route::get('', [
//        'uses'=> 'PostController@getAdminIndex',
//        'as' => 'admin'
//    ]);
//
//    Route::get('/create', [
//        'uses' => 'PostController@createPostPage',
//        'as' => 'create-post'
//    ]);
//
//    Route::get('/edit/{id}', [
//        'uses' => 'PostController@editPost',
//        'as' => 'edit-post'
//    ]);
//
//    Route::post('/create', [
//        'uses' => 'PostController@createPost',
//        'as' => 'create-form'
//    ]);
//
//    Route::post('/edit', [
//        'uses' => 'PostController@updatePost',
//        'as' => 'update-form'
//    ]);
//
//    Route::get('/delete/{id}', [
//        'uses' => 'PostController@deletePost',
//        'as' => 'delete-post'
//    ]);
});

Route::group(['prefix' => 'forms'], function() {

    Route::post('/create-article', [
        'uses' => 'ArticleController@createArticle',
        'as' => 'article-form-submit'
    ]);

    Route::post('/edit-article', [
        'uses' => 'ArticleController@editArticle',
        'as' => 'edit-article-submit'
    ]);

});


Auth::routes();

Route::post('login', [
    'uses' => 'SigninController@signin',
    'as' => 'login'
]);


<?php

use Illuminate\Support\Facades\Route;

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
//Login
Route::any('/login','UserController@login')->name('login');

Route::group(['middleware' => ['auth', 'checkPermission']], function () {
    /*Home*/
    Route::get('/home','HomeController@index');
    /*Ajax*/
    Route::post('/ajax/changePassword','AjaxController@changePassword');
    Route::post('/ajax/loadTag','AjaxController@loadTag');
    Route::post('/ajax/loadCategory','AjaxController@loadCategory');
    Route::post('/ajax/loadCategoryAuthor','AjaxController@loadCategoryAuthor');
    Route::get('/ajax/get-posts', 'AjaxController@getJsonPosts');

    /*Category*/
    Route::get('/category','CategoryController@index');
    Route::any('/category/update','CategoryController@update');
    Route::any('/category/update/{id}','CategoryController@update')->where(['id' => '[0-9]+']);
    Route::any('/category/delete/{id}','CategoryController@delete')->where(['id' => '[0-9]+']);
    Route::get('/category/export-excel','CategoryController@exportExcel');

    /* category author*/
    Route::get('/category/author', 'CategoryAuthorController@index');
    Route::any('/category/author/update','CategoryAuthorController@update');
    Route::any('/category/author/update/{id}','CategoryAuthorController@update')->where(['id' => '[0-9]+']);
    Route::any('/category/author/delete/{id}','CategoryAuthorController@delete')->where(['id' => '[0-9]+']);
    /*User*/
    Route::any('/user','UserController@index');
    Route::any('/user/update','UserController@update');
    Route::any('/user/update/{id}','UserController@update')->where(['id' => '[0-9]+']);
    Route::any('/user/delete/{id}','UserController@delete')->where(['id' => '[0-9]+']);
    Route::any('/user/logout','UserController@logout');
    /*Tag*/
    Route::get('/tag','TagController@index');
    Route::any('/tag/update','TagController@update');
    Route::any('/tag/update/{id}','TagController@update')->where(['id' => '[0-9]+']);
    Route::any('/tag/delete/{id}','TagController@delete')->where(['id' => '[0-9]+']);
    Route::get('/tag/export-excel','TagController@exportExcel');
    /*Post*/
    Route::get('/post','PostController@index');
    Route::any('/post/update','PostController@update');
    Route::any('/post/update/{id}','PostController@update')->where(['id' => '[0-9]+']);
    Route::any('/post/delete/{id}','PostController@delete')->where(['id' => '[0-9]+']);
    Route::get('/post/export-excel','PostController@exportExcel');
    /*Page*/
    Route::get('/page','PageController@index');
    Route::any('/page/update','PageController@update');
    Route::any('/page/update/{id}','PageController@update')->where(['id' => '[0-9]+']);
    Route::any('/page/delete/{id}','PageController@delete')->where(['id' => '[0-9]+']);
    Route::get('/page/export-excel','PageController@exportExcel');

    Route::any('/post/featured-post', 'FeaturedPostController@index');

    /*Group Permission*/
    Route::get('/group','GroupController@index');
    Route::any('/group/update','GroupController@update');
    Route::any('/group/update/{id}','GroupController@update')->where(['id' => '[0-9]+']);
    Route::any('/group/delete/{id}','GroupController@delete')->where(['id' => '[0-9]+']);
    /*Nha cai*/
    Route::get('/nha_cai/{type}','Nha_CaiController@index')->where(['type' => '[0-9]+']);
    Route::any('/nha_cai/update/{type}','Nha_CaiController@update')->where(['type' => '[0-9]+']);
    Route::any('/nha_cai/update/{type}/{id}','Nha_CaiController@update')->where(['type' => '[0-9]+', 'id' => '[0-9]+']);
    Route::any('/nha_cai/delete/{id}','Nha_CaiController@delete')->where(['id' => '[0-9]+']);
    /*Football league*/
    Route::get('/football_league','Football_leagueController@index');
    Route::any('/football_league/update','Football_leagueController@update');
    Route::any('/football_league/update/{id}','Football_leagueController@update')->where(['id' => '[0-9]+']);
    Route::any('/football_league/delete/{id}','Football_leagueController@delete')->where(['id' => '[0-9]+']);
    /*Site setting*/
    Route::any('/site_setting/update','Site_SettingController@update');
    /*Redirect*/
    Route::get('/redirect','RedirectController@index');
    Route::any('/redirect/update','RedirectController@update');
    Route::any('/redirect/update/{id}','RedirectController@update')->where(['id' => '[0-9]+']);
    Route::any('/redirect/delete/{id}','RedirectController@delete')->where(['id' => '[0-9]+']);
    /*Menu*/
    Route::get('/menu','MenuController@index');
    Route::any('/menu/update','MenuController@update');
    Route::any('/menu/update/{id}','MenuController@update')->where(['id' => '[0-9]+']);
    Route::any('/menu/delete/{id}','MenuController@delete')->where(['id' => '[0-9]+']);
    /*Banner*/
    // Route::get('/banner','BannerController@index');
    // Route::any('/banner/update','BannerController@update');
    // Route::any('/banner/update/{id}','BannerController@update')->where(['id' => '[0-9]+']);
    // Route::any('/banner/delete/{id}','BannerController@delete')->where(['id' => '[0-9]+']);
});

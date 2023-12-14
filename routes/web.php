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

/*404*/

Route::any('/404.html', 'PageController@not_found');



Route::get('/','HomeController@index');

Route::get('/{slug}-p{id}.html', 'PostController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+'])->middleware('Redirect.301');

/*Category*/

// Route::get('/{slug}-c{id}', 'CategoryController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+'])->middleware('Redirect.301');
Route::get('/{slug}-7m', 'CategoryController@index')->where(['slug' => '[\s\S]+'])->middleware('Redirect.301');

Route::get('/{slug}-c{id}/{page}', 'CategoryController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+','page' => '[0-9]+'])->middleware('Redirect.301');

Route::get('/{slug}-pt{id}.html', 'PageController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+'])->middleware('Redirect.301');

Route::get('/load-more-posts/{category_id}/{page}', 'CategoryController@loadMorePost');

Route::get('/search/load-more-posts', 'SearchController@loadMorePost');

Route::get('/tag/load-more-posts/{tagid}/{page}', 'TagController@loadMorePosts');

Route::get('/tim-kiem', 'SearchController@index');

Route::get('/{slug}-t{id}', 'TagController@index')->where(['slug' => '[\s\S]+', 'id' => '[0-9]+']);

/*Sitemap*/

Route::get('/sitemap.xml', 'SitemapController@index');

Route::get('/sitemap-category.xml', 'SitemapController@category');

Route::get('/sitemap-news.xml', 'SitemapController@news');

Route::get('/sitemap-page.xml', 'SitemapController@page');

Route::get('/sitemap-tag.xml', 'SitemapController@tag');

Route::get('/sitemap-posts-{year}-{month}.xml', 'SitemapController@post')->where(['year'=>'\d+', 'month'=>'\d+']);

/*Rss*/

Route::get('/rss-feed', 'RssController@index');

Route::get('/rss/home.rss', 'RssController@home');

Route::get('/rss/{slug}.rss', 'RssController@detail')->where(['slug' => '[\s\S]+']);

/*Crawler*/

Route::get('/crawler/{slug}', 'CrawlerController@index')->where(['slug' => '[\s\S]+']);

Route::post('/crawler/may_tinh_du_doan', 'CrawlerController@may_tinh_du_doan');

Route::post('/crawler/lich_thi_dau_ithethao', 'CrawlerController@lich_thi_dau_ithethao');

/*Ajax*/

Route::get('/ajax_get_ltd/{date}', 'AjaxController@ajax_get_ltd')->where(['date' => '.*']);

/*Any*/

Route::any('{slug}', 'PageController@any')->where('slug', '.*');




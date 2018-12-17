<?php

use Illuminate\Http\Request;

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

Auth::routes();
Route::get('/', 'HomeController@index');


// Website
Route::get('website', 'WebsiteController@index');
Route::get('website/add', 'WebsiteController@create');
Route::post('website', 'WebsiteController@store');
Route::get('website/{website}/edit', 'WebsiteController@edit');
Route::patch('website/{website}', 'WebsiteController@update');
Route::delete('website/{website}', 'WebsiteController@destroy');
Route::get('website/{website}/feed', 'WebsiteController@show'); // display feed

// Category
Route::get('category', 'CategoryController@index');
Route::post('category', 'CategoryController@store');
Route::get('category/all', 'CategoryController@all');
Route::delete('category/{category}', 'CategoryController@destroy');
Route::get('category/{category}', 'CategoryController@show'); //shows a 404 page




// Working on my templates
Route::get('template', function () {
    return view('tests.template');
});


// Working with News Feed 
Route::get('/newsfeed', function () {
	// $url = 'https://threatpost.com/feed/';
	// $url = 'https://www.weybanskytech.com.ng/feed';
	// $url = 'https://medium.com/feed/the-story';
	$url = 'http://raqeebahshittu.blogspot.com/feeds/posts/default?alt=rss';

	try {
		$rss = \Feed::loadRss($url);
		$items = $rss->item;
		
	} catch (Exception $e) {
		// abort(500);
		$atom = \Feed::loadAtom($url);
		$entries = $atom->entry;

	}
	dd($rss);

	return view('tests.rss', compact('items'));
});

Route::get('axios', function () {
	return view('tests.axios');
});
Route::post('axios', function () {
	$websites = \App\Website::get();
	// return $websites;
	return response()->json(array('websites' => $websites), 200);
});


Route::get('feed/add-new-entry', function () {
	$websites = \App\Website::select(['id', 'feed_url', 'type_of_feed'])->orderBy('id')->get();
	// go through all feed urls 
	foreach ($websites as $website) {
		// check feed type and use the required function
		// return $feed;
		if ($website->type_of_feed == 'rss') {
			try {
				$rss = \Feed::loadRss($website->feed_url);
				$items = $rss->item;
				dd($rss);

			} catch (Exception $e) {
				return 'RSS Feed Not Working';
				abort(500);
			}
		}elseif ($website->type_of_feed == 'atom') {
			try {
				$atom = \Feed::loadAtom($website->feed_url);
				$entries = $atom->entry;
				dd($atom);
				
			} catch (Exception $e) {
				return 'Atom Feed Not working';
				abort(500);
			}
		}

	}

});

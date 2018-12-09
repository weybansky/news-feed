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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// ========================



// Websites
// Adding new websites
Route::get('add-new-website', 'WebsiteController@create');
Route::post('add-new-website', 'WebsiteController@store');

Route::get('edit-website', 'WebsiteController@edit');
Route::patch('edit-website', 'WebsiteController@update');

Route::delete('delete-website', 'WebsiteController@destroy');

Route::get('all-websites', 'WebsiteController@index');


// =========================


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
	$feeds = \App\Website::select(['id', 'feed_url', 'type_of_feed'])->orderBy('id')->get();
	// go through all feed urls 
	foreach ($feeds as $feed) {
		// check feed type and use the required function
		// return $feed;
		if ($feed->type_of_feed == 'rss') {
			try {
				$rss = \Feed::loadRss($feed->feed_url);
				$items = $rss->item;
				dd($rss);

			} catch (Exception $e) {
				return 'Not Working Rss';
				abort(500);
			}
		}elseif ($feed->type_of_feed == 'atom') {
			try {
				$atom = \Feed::loadAtom($feed->feed_url);
				$entries = $atom->entry;
				dd($atom);
				
			} catch (Exception $e) {
				return 'Not working Atom';
				abort(500);
			}
		}

	}

});

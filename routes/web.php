<?php

use App\Feed;
use App\Website;
use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Route;

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
// Route::get('/', 'HomeController@index');
Route::get('/', 'FeedController@index');

// Category
Route::get('category', 'CategoryController@index');
Route::post('category', 'CategoryController@store');
Route::get('category/all', 'CategoryController@all');
Route::delete('category/{category}', 'CategoryController@destroy');
Route::patch('category/{category}', 'CategoryController@update');
Route::get('category/{category}/feed', 'CategoryController@show');


// Website
Route::get('website', 'WebsiteController@index');
Route::get('website/add', 'WebsiteController@create');
Route::post('website', 'WebsiteController@store');
Route::get('website/{website}/edit', 'WebsiteController@edit');
Route::patch('website/{website}', 'WebsiteController@update');
Route::delete('website/{website}', 'WebsiteController@destroy');
Route::get('website/{website}/feed', 'WebsiteController@show'); // display feed


// Feed
Route::get('feed/run/{website}', 'FeedController@single');
Route::get('feed/run', 'FeedController@all');
Route::get('feed', 'FeedController@index');

Route::get('nonsense', function () {
	$url = "http://127.0.0.1/wordpress/index.php/2019/01/30/hello-world/";
	$url = "http://127.0.0.1/iworder/hub";
	$url = "http://127.0.0.1/w3schools/";
	// $url = "http://127.0.0.1/wordpress/wp-content/uploads/2019/01/admin.jpg";

	$ch = curl_init($url);
	// curl_setopt($ch, CURLOPT_HEADER, true);    // we dont need headers
	curl_setopt($ch, CURLOPT_NOBODY, false);    // we need the body
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // returns the output as string
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$output = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	// $tags = get_meta_tags($url); // metas
	$headers = get_headers($url); //headers

	$string = "<div>this is a div</div>";
	$delimeter_meta = '/<meta[ a-zA-Z0-9\/\_=\"\',.-]*>/';
	$delimeter_div = '/<div[a-z>A-Z ]*</div>/';
	$delimeter_favicon = '/<link ?([ a-zA-Z="\'\/\+&;:0-9\.-]*)?(rel="icon")?(favicon.{3,6}")([ a-zA-Z="\'\/\+&;:0-9\.-]*)>/';
	$delimeter_link = '/<link([ a-zA-Z="\'\/\+&;:0-9\.-]*)>/';

	$tags = [];
	preg_match_all($delimeter_link, $output, $tags, PREG_SPLIT_NO_EMPTY);

	return [
		"tags" => $tags,
		"httpcode" => $httpcode,
		"headers" => $headers,
		"output" => $output,
	];

	// return \Carbon\Carbon::today()->subDay(3);

	// $postContent = "<a href=\"https://www.vanguardngr.com/2019/01/you-cannot-blame-amaechi-for-onnoghen-apc-rivers-problems-dakuku/\"><img width=\"107\" height=\"107\" src=\"https://www.vanguardngr.com/wp-content/uploads/2018/07/Dakuku-Peterside-e1531392690350-107x107.jpg\" alt=\"You cannot blame Amaechi for Onnoghen, APC Rivers’ problems  – Dakuku\" align=\"left\" style=\"margin: 0 20px 20px 0\" /></a><p>The party in the state has lately been thrown into hysteria following the judicial ban on the party from fielding candidates for state level elections. In this interview in Port-Harcourt at the weekend, Dr. Peterside, who is also the Director-General of the Nigerian Maritime Administration and Safety Agency, NIMASA, expresses confidence in the party overturning the judicial ban even as he addresses questions on the culpability of the major actors in the affair. Excerpts:</p>\n<p><a href=\"https://www.vanguardngr.com/2019/01/you-cannot-blame-amaechi-for-onnoghen-apc-rivers-problems-dakuku/\" rel=\"nofollow\">Continue reading You cannot blame Amaechi for Onnoghen, APC Rivers’ problems  – Dakuku at Vanguard News Nigeria.</a></p>\n";
	// return $postContent;
});

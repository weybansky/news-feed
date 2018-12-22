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
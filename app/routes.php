<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
  'as'   => 'home',
  'uses' => 'UserController@index'
));

Route::get('/tweets/{group}', array(
  'as' => 'tweets',
  'uses' => 'TweetController@index'
));

Route::post('/tweets/search', 
  'TweetController@postSearch');

Route::get('/tweets/popular/{group}', array(
  'as' => 'tweets.popular',
  'uses' => 'TweetController@getPopular',
)

);

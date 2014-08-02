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

/**
 * Controller possibilities
 * / =-> home
   /profile =-> all users
   /profile/{screen_name} =-> specific user
   /tag
   /search
   /leaders
   /
 */

Route::get('/', 'ProfileController@index');

Route::get('/engagement-account/{acct}', function($acct) {

  $q = "
    SELECT *
    FROM tc_user
    WHERE screen_name = ?
  ";

  $user = DB::select($q, array($acct));

  return View::make('engagement-account')
    ->with('acct', $acct)
    ->with('user', $user[0]);

});


// names the route 'profile'; 
// we refer to this route in the view in order to make some links;
// in the array arg, notice as pass the controller with 'uses'
Route::get('/profile/{screen_name}', array('as' => 'profile', 
  'uses' => 'ProfileController@show'));


// test mysql connection
Route::get('mysql-test', function() {
  
  // use the DB component to select all the databases
  $results = DB::select('show databases');

  echo Paste\Pre::r($results);

});

// test Eloquent ORM
Route::get('/practice-reading', function() {
  //$user_id = 19262807;

  // get TheDO
  $tweet = Tweet::first();
  //$user = User::find($user_id);
  $user = User::where('user_id', '=', '19262807');
    //->first();
  //$user = User::first();

  echo Paste\Pre::r($user->first()->screen_name);

});

// from susan's notes
Route::get('/debug', function() {
  
  echo '<pre>';

  echo '<h1>environment.php</h1>';
  $path = base_path() . '/environment.php';
  
  try {
    $contents = 'Contents: ' . File::getRequire($path);
    $exists = 'Yes';
  } catch (Exception $e) {
    $exists = 'No. Defaulting to `production`';
    $contents = '';
  }

  echo '</pre>';
});

Route::get('tweets/{screen_name}', function($screen_name) {

  $user = User::where('screen_name', '=', $screen_name)
    ->first();

});

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

Route::get('/{name?}', function($name = 'World')
{
  return View::make('hello')->with('name', $name);
});

Route::get('/engagement-account/{acct}', function($acct) {

  //$data['acct'] = $acct;

  return View::make('engagement-account')
    ->with('acct', $acct);

});

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

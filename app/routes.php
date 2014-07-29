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

Route::get('/', function() {

  $q = "
    select user_id, screen_name, profile_image_url
    from tc_user
    where user_id in (
      select user_id
      from tc_engagement_account
    )
  ";

  $data = DB::select($q);
  foreach ($data as $user) {
    $user->url = 
      URL::to('engagement-account/' . $user->screen_name);
  }

  // send our $data array to the view
  return View::make('home')->with('data', $data);

});

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

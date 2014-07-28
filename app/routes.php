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

Route::get('/', function()
{
	return View::make('_master');
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

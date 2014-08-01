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
    union
    select user_id, screen_name, profile_image_url
    from tc_user
    where user_id in (
      select user_id
      from tc_leader
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

Route::get('/user-profile/{screen_name}', array('as' => 'user-profile', 
  function($screen_name) {

  $user = User::where('screen_name', '=', $screen_name)
    ->first();

  //$tweet_query = Tweet::where('user_id', '=', $user->user_id)
  //$tweet_query = Tweet::get('user_id', '=', $user->user_id)
    //->first();

  $tweets = DB::table('tc_tweet')
    ->select(DB::raw('count(*) as total_tweets, 
        min(created_at) as tweets_since'))
    ->addSelect(DB::raw(
        "datediff(max(created_at), min(created_at)) as tweet_days"
      ))
    ->where('user_id', '=', $user->user_id)
    ->first();

  $mentions = DB::table('tc_tweet_mention')
    ->where('target_user_id', '=', $user->user_id)
    ->selectRaw('count(*) as mentioned_count')
    ->first();

  $retweeted = DB::table('tc_tweet_retweet')
    ->where('target_user_id', '=', $user->user_id)
    ->selectRaw('count(*) as retweeted_count')
    ->first();

  // get the tags most used by this user
  $favorite_tags = DB::table('tc_tweet_tag')
    ->where('user_id', '=', $user->user_id)
    ->selectRaw('count(*) as count, tag')
    ->groupBy('tag')
    ->orderBy('count', 'desc')
    ->get();

  // get screen_names of users mentioned most by this user
  // select count(*) as count, u.screen_name, u.user_id
  // from tc_tweet_mention tm inner join tc_user u
  //   on tm.target_user_id = u.user_id
  // where tm.source_user_id = 22638297
  // group by u.screen_name
  // order by count desc

  $most_mentioned = DB::table('tc_tweet_mention')
    ->join('tc_user', 'tc_tweet_mention.target_user_id', '=',
        'tc_user.user_id')
    ->where('tc_tweet_mention.source_user_id', '=', $user->user_id)
    ->selectRaw('count(*) as count, tc_user.screen_name, tc_user.user_id')
    ->groupBy('tc_tweet_mention.target_user_id')
    ->orderBy('count', 'desc')
    ->get();

  $most_mentioners = DB::table('tc_tweet_mention')
    ->join('tc_user', 'tc_tweet_mention.source_user_id', '=',
        'tc_user.user_id')
    ->where('tc_tweet_mention.target_user_id', '=', $user->user_id)
    ->selectRaw('count(*) as count, tc_user.screen_name, tc_user.user_id')
    ->groupBy('tc_tweet_mention.source_user_id')
    ->orderBy('count', 'desc')
    ->get();

  return View::make('user-profile')
    ->with('user', $user)
    ->with('tweets', $tweets)
    ->with('mentioned_per_day', 
        number_format(
          $mentions->mentioned_count / $tweets->tweet_days, 1
        )
    )
    ->with('tweets_per_day', 
        number_format(
          $tweets->total_tweets / $tweets->tweet_days, 1
        )
    )
    ->with('retweeted_per_day', 
        number_format(
          $retweeted->retweeted_count / $tweets->tweet_days, 1
        )
    )
    ->with('retweeted_per_tweet', 
        number_format(
          $retweeted->retweeted_count / $tweets->total_tweets, 1
        )
    )
    ->with('favorite_tags', $favorite_tags)
    ->with('most_mentioned', $most_mentioned)
    ->with('most_mentioners', $most_mentioners);
}));

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

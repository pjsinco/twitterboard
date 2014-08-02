<?php

class LeaderController extends BaseController
{

  public function __construct() {
  
  }
  
  public function getTweets() {

    $q = "
      SELECT t.tweet_text, t.created_at, u.screen_name, u.name, 
        u.user_id, t.retweet_count, t.favorite_count, 
        u.profile_image_url
      FROM tc_tweet t inner join tc_user u
        on t.user_id = u.user_id
      WHERE t.user_id in (
        select user_id
        from tc_leader
      )
      order by t.created_at DESC
      limit 100
    ";

    $tweets = DB::select($q);

    return View::make('leader.tweets')
      ->with('tweets', $tweets);
  }

  public function getTweetsPopular() {

    $q = "
      SELECT t.tweet_text, t.created_at, u.screen_name, u.name, 
        u.user_id, t.retweet_count, t.favorite_count, 
        u.profile_image_url
      FROM tc_tweet t inner join tc_user u
        on t.user_id = u.user_id
      where t.user_id in (
        select user_id
        from tc_leader
      )
      order by t.retweet_count DESC
      limit 100
    ";

    $tweets = DB::select($q);

    return View::make('leader.tweets')
      ->with('tweets', $tweets);
  }

  public function getMentions() {
    // body...
  }

  public function getRetweets() {
    // body...
  }

  public function getTags() {
    // body...
  }


} // eoc

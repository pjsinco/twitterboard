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

  /*
   * @param  array  dates
   *   (array('to' => 'yyyy-mm-dd', 'from' => 'yyyy-mm-dd'))
   */
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

  public function postSearchPopularTweets() {
    // $start is either 1 year ago today or 
    //    the value set by the request
    if (Request::input('start')) {
      $start = Request::input('start');
    } else {
      $start = date('Y-m-d', strtotime('-1 year'));
    }
    
    if (Request::input('end')) {
      $end = Request::input('end');
    } else {
      $end = $start;
    }

    if (Request::ajax()) {
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
          and t.created_at >= '" . $start . "'
          and t.created_at <= '" . $end . "'
        order by t.retweet_count DESC
        limit 100
      ";
    } 

    return DB::select($q);

  }

  public function getMentions() {

    $q = "
      SELECT 
      FROM 
      WHERE 
    ";

    return View::make('leader.tweets')
      ->with('tweets', $tweets);

  }

  public function getRetweets() {
    // body...
  }

  public function getTags() {
    // body...
  }


} // eoc

<?php

class LeaderController extends BaseController
{

  private $query = "
    SELECT t.tweet_text, t.created_at, u.screen_name, u.name, 
      u.user_id, t.retweet_count, t.favorite_count, 
      u.profile_image_url
    FROM tc_tweet t inner join tc_user u
      on t.user_id = u.user_id
    where t.user_id in (
      select user_id
      from tc_leader
    )
  ";

  public function __construct() {
  
  }
  
  public function getTweets() {

    $this->query .= "
      order by t.created_at DESC
      limit 100
    ";

    $tweets = DB::select($this->query);

    return View::make('leader.tweets')
      ->with('tweets', $tweets);
  }

  public function getTweetsPopular() {

    $this->query .= "
      and (
        t.retweet_count > 0 
          or t.favorite_count > 0)
      order by t.retweet_count DESC
      limit 100
    ";

    $tweets = DB::select($this->query);

    return View::make('leader.tweets')
      ->with('tweets', $tweets);
  }

  public function postSearchTweets() {
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
      $this->query .= "
        and (
          t.retweet_count > 0 
            or t.favorite_count > 0)
        and t.created_at >= '" . $start . "'
        and t.created_at <= '" . $end . "'
        order by t.retweet_count DESC
        limit 100
      ";
    } 

    return DB::select($this->query);

  }

  public function getMentions() {

    $q = "
      SELECT count(*) as count, u.*
      FROM tc_tweet_mention tm inner join tc_user u
        on tm.target_user_id = u.user_id
      WHERE tm.source_user_id in (
        select user_id
        from tc_leader
      )
      group by tm.target_user_id
      order by count desc;
    ";

    $users = DB::select($q);
  
    return View::make('user.index')
      ->with('users', $users);

  }

  public function getRetweets() {
    // body...
  }

  public function getTags() {
    // body...
  }


} // eoc

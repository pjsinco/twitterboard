<?php

class TweetController extends BaseController
{

  public function __construct() {
    // body...
  }

  public function index($group) {

    JavaScript::put([
      'group' => $group,
      'controller' => 'tweet',
      'filter' => '',
    ]);

    return View::make('tweet.blank');
  }

  public function show($tweet_id) {
    
  }

  public function getPopular($group) {

    JavaScript::put([
      'group' => $group,
      'controller' => 'tweet',
      'filter' => 'popular',
    ]);

    return View::make('tweet.blank');
    
  }

  public function postSearch() {

    $filter = Request::input('filter');
    $start = Request::input('start');
    $end = Request::input('end');
    $group = Request::input('group');
    $q = '';

    if ($group == 'leaders') { 
      $q .= "
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
       ";
    } else if ($group == 'us') {
      $q .= "
        SELECT t.tweet_text, t.created_at, u.screen_name, u.name, 
          u.user_id, t.retweet_count, t.favorite_count, 
          u.profile_image_url
        FROM tc_tweet t inner join tc_user u
          on t.user_id = u.user_id
        where t.user_id in (
          select user_id
          from tc_engagement_account
        )
        and t.created_at >= '" . $start . "'
        and t.created_at <= '" . $end . "'
       ";
    }

    // no filter, so we want all tweets
    if (!$filter) {
      $q .= "
        order by t.created_at DESC
        limit 100
      ";
    }

    
    // grab the popular tweets
    if ($filter == 'popular') {
      $q .= "
        and (
          t.retweet_count > 0 
            or t.favorite_count > 0)
        order by t.retweet_count DESC
        limit 100
      ";
    } 

    //echo Pre::r($q);
    return DB::select($q);

  }


} // eoc

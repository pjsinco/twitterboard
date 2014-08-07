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

    return View::make('includes.blank');

  }

  public function getPopular($group) {

    JavaScript::put([
      'group' => $group,
      'controller' => 'tweet',
      'filter' => 'popular',
    ]);

    return View::make('includes.blank');
    
  }

  public function postSearch() {

    $filter = Request::input('filter');
    $start = Request::input('start');
    $end = Request::input('end');
    $group = Request::input('group');
    $q = '';

    if ($group = 'leaders' && Request::ajax()) {
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
        and (
          t.retweet_count > 0 
            or t.favorite_count > 0)
        and t.created_at >= '" . $start . "'
        and t.created_at <= '" . $end . "'
        order by t.retweet_count DESC
        limit 100
      ";
    } 

    return DB::select($q);

  }


} // eoc

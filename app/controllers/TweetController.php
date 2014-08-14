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

    return View::make('tweet.blank')
      ->with('group', $group);
  }

  public function show($tweet_id) {
    
    return View::make('tweet.show');
  }

  public function getPopular($group) {

    $filter = 'popular';

    JavaScript::put([
      'group' => $group,
      'controller' => 'tweet',
      'filter' => $filter,
    ]);

    return View::make('tweet.blank')
      ->with('group', $group)
      ->with('filter', $filter);
    
  }

  public function getSearchTweets() {

    return View::make('tweet.search')
      ->with('search_entity', 'tweets');

  }

  public function postSearchTweets() {
    $start = Request::input('start');
    $end = Request::input('end');

    if (Request::ajax()) {
    
      $terms = explode(' ', Request::input('terms'));
      // ex. with date_format:
      // select t.tweet_text, date_format(t.created_at, '%b. %d') as created_at, u.name, 
      $q = "
        select t.tweet_id, t.tweet_text, t.created_at, u.name, 
          u.screen_name, t.retweet_count, t.favorite_count,
          u.profile_image_url
        from tc_tweet t inner join tc_user u
          on t.user_id = u.user_id
        where
      ";
      
      for ($i = 0; $i < count($terms); $i++) {
        $term = trim($terms[$i]);
        if ($i != 0) { // fix fence post
          $q .= ' and ';
        }
        $q .= " t.tweet_text like '%$term%'";
      }

      $q .= ' order by t.created_at DESC';
      $q .= ' limit 100';

      //$q .= "and t.created_at >= '$start'
        //and t.created_at <= '$end'";

      $results = DB::select($q);
    
      foreach ($results as $result) {

        // format the date
        $result->created_at = 
          $this->format_date($result->created_at);

        // replace characters 
        $result->tweet_text = 
           $this->format_string($result->tweet_text);
      }

      return $results;
    }
  }


  public function postSearch() {

    $filter = Request::input('filter');
    $start = Request::input('start');
    $end = Request::input('end');
    $group = Request::input('group');
    $q = '';

    if ($group == 'circle') { 
      $q .= "
        SELECT t.tweet_text, t.created_at, t.tweet_id,
          u.screen_name, u.name, 
          u.user_id, t.retweet_count, t.favorite_count, 
          u.profile_image_url
        FROM tc_tweet t inner join tc_user u
          on t.user_id = u.user_id
        where t.created_at >= '" . $start . "'
        and t.created_at <= '" . $end . "'
       ";
    } else if ($group == 'leaders') { 
      $q .= "
        SELECT t.tweet_text, t.tweet_id, t.created_at, u.screen_name, 
          u.name, u.user_id, t.retweet_count, t.favorite_count, 
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
    $results = DB::select($q);

    foreach ($results as $result) {
      $result->created_at = 
        $this->format_date($result->created_at);

      $result->tweet_text = 
        $this->format_string($result->tweet_text);
    }

    return $results;
  }

  // replaces weird characters in strings
  private function format_string($string) {

    return str_replace(array(
      "\xE2\x80\x98", 
      "\xE2\x80\x99", 
      "\xE2\x80\x9C", 
      "\xE2\x80\x9D",
      "\xE2\x80\xa6",
      "â€™",
      "Â",
      "â€",
      "œ",
      "Ã",
      "ðŸ˜¨",
    ),  array( "'", "'", '"', '"', "...", "'", " ", '"', '"',
      "í", "&#128552;"), 
      $string);
    
  }

  private function format_date($date) {
    return date('F d', strtotime($date));
  }

} // eoc

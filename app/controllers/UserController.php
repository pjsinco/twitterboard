<?php

class UserController extends BaseController
{

  public function __construct() {
    // body...
  }

  public function index($group = NULL) {

    JavaScript::put([
      'group' => $group,
      'controller' => 'user',
      'filter' => ''
    ]);

    return View::make('includes.blank');

  }

  public function show($screen_name) {

    $user = User::where('screen_name', '=', $screen_name)
      ->first();

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
    // todo find a way to deal with long tags
    //   --see @drlennypowell
    //   --#peoplewatchingmepracticeincarthinkingwth
    //   --that runs into and over the next column!
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
      ->selectRaw('
          count(*) as count, tc_user.screen_name, tc_user.user_id
      ')
      ->groupBy('tc_tweet_mention.target_user_id')
      ->orderBy('count', 'desc')
      ->get();
  
    $most_mentioners = DB::table('tc_tweet_mention')
      ->join('tc_user', 'tc_tweet_mention.source_user_id', '=',
          'tc_user.user_id')
      ->where('tc_tweet_mention.target_user_id', '=', $user->user_id)
      ->selectRaw('
        count(*) as count, tc_user.screen_name, tc_user.user_id
      ')
      ->groupBy('tc_tweet_mention.source_user_id')
      ->orderBy('count', 'desc')
      ->get();

    return View::make('user.show')
      ->with('user', $user)
      ->with('tweets', $tweets)
      ->with('mentioned_per_day', 
          number_format(
            $mentions->mentioned_count / $tweets->tweet_days, 2
          )
      )
      ->with('tweets_per_day', 
          number_format(
            $tweets->total_tweets / $tweets->tweet_days, 2
          )
      )
      ->with('retweeted_per_day', 
          number_format(
            $retweeted->retweeted_count / $tweets->tweet_days, 2
          )
      )
      ->with('retweeted_per_tweet', 
          number_format(
            $retweeted->retweeted_count / $tweets->total_tweets, 2
          )
      )
      ->with('favorite_tags', $favorite_tags)
      ->with('most_mentioned', $most_mentioned)
      ->with('most_mentioners', $most_mentioners);
    
  }

  public function postSearch() {
    // body...
  }
  
  public function getMentionsBy($group) {

    JavaScript::put([
      'group' => $group,
      'controller' => 'user',
      'filter' => 'Mentioned By'
    ]);

    return View::make('includes.blank');
  }


} // eoc


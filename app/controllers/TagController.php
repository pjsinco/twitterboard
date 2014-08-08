<?php

class TagController extends BaseController
{

  public function __construct() {
    // body...
  }

  public function index($group) {

    JavaScript::put([
      'group' => $group,
      'controller' => 'tag',
      'action' => 'tags',
      'label' => 'tags',
      'filter' => ''
    ]);

    return View::make('tag.index')
      ->with('group', $group);
  }

  public function show($id) {
    // body...
  }

  public function postSearch() {
    $start = Request::input('start');
    $end = Request::input('end');
    $group = Request::input('group');

    if ($group == 'leaders') {
      $table = 'tc_leader';
    } else if ($group == 'us') {
      $table = 'tc_engagement_account';
    }

    if (Request::ajax()) {
      $q = "
        select count(*) as count, tag
        from tc_tweet_tag 
        where user_id in (
          select user_id
          from $table
        )
        and created_at >= '" . $start . "'
        and created_at <= '" . $end . "'
        group by tag
        order by count desc, tag asc
        limit 100
      ";
    }

    return DB::select($q);
    
  }


} // eoc

<?php

class TweetController extends BaseController
{

  public function __construct() {
    // body...
  }

  public function index($group) {

    echo $group;
    return View::make('includes.blank');

  }


} // eoc

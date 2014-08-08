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
      'filter' => ''
    ]);

    return View::make('tag.blank');
  }

  public function show($id) {
    // body...
  }

  public function postSearch() {
    // body...
  }


} // eoc

<?php 

class Tweet extends Eloquent
{

  protected $table = 'tc_tweet';
  protected $primaryKey = 'tweet_id';
  public $incrementing = false;

} // eoc

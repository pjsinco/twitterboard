<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent 
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'tc_user';

  /**
   * The primary key used by the model
   * 
   * @var string
   */
  protected $primaryKey = 'user_id';

  /**
   * Whether the primary key auto-increments
   */
  public $incrementing = false;

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  //protected $hidden = array('password', 'remember_token');

}

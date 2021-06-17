<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterCardClass extends Model
{
  //
  protected $guarded = array('id');

  // 以下を追記
  public static $rules = array(

      'class_id' => 'required',
      
  );
}

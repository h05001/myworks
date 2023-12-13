<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterCardClass extends Model
{
  //
  protected $guarded = array('id');

  // 以下を追記
  public static $rules = array(

      //'class_id' => ['required' , 'regex:/[0-9]+/'],
      'class_id' => 'required | array',
      'class_id.*' => 'integer',

  );
  public function monsterClassMaster()
  {
    return $this->hasone('App\MonsterClassMaster','id','class_id');

  }
}

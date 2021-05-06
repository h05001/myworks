<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterClassMaster extends Model
{
    protected $guarded = array('id');
    //
    public static $rules = array(

      'monster_class' => 'required',

    );
}

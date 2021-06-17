<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterCardDetail extends Model
{
    //
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(

        'property' => 'required',
        'tribe' => 'required',
        //'level' => 'required',
        //'rank' => 'required',
        //'scale' => 'required',
        //'pendulum_effect' => 'required',
        //'link' => 'required',
        //'link_marker' => 'required',
        'attack' => 'required',
        //'defense' => 'required',

    );
}

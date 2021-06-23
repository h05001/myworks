<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterCardDetail extends Model
{
    //
    protected $guarded = array('id');

    //エクシーズ、ペンデュラム、リンク以外
    public static $rules1 = array(

        'property' => 'required',
        'tribe' => 'required',
        'level' => 'required',
        //'rank' => 'required',
        //'scale' => 'required',
        //'pendulum_effect' => 'required',
        //'link' => 'required',
        //'link_marker' => 'required',
        'attack' => 'required',
        'defense' => 'required',

    );
    //エクシーズ
    public static $rules2 = array(

        'property' => 'required',
        'tribe' => 'required',
        //'level' => 'required',
        'rank' => 'required',
        //'scale' => 'required',
        //'pendulum_effect' => 'required',
        //'link' => 'required',
        //'link_marker' => 'required',
        'attack' => 'required',
        'defense' => 'required',

    );

    //ペンデュラム
    public static $rules3 = array(

        'property' => 'required',
        'tribe' => 'required',
        'level' => 'required',
        //'rank' => 'required',
        'scale' => 'required',
        'pendulum_effect' => 'required',
        //'link' => 'required',
        //'link_marker' => 'required',
        'attack' => 'required',
        'defense' => 'required',

    );

    //リンク
    public static $rules4 = array(

        'property' => 'required',
        'tribe' => 'required',
        //'level' => 'required',
        //'rank' => 'required',
        //'scale' => 'required',
        //'pendulum_effect' => 'required',
        'link' => 'required',
        'link_marker' => 'required',
        'attack' => 'required',
        //'defense' => 'required',

    );

    //エクシーズ＆ペンデュラム
    public static $rules5 = array(

        'property' => 'required',
        'tribe' => 'required',
        //'level' => 'required',
        'rank' => 'required',
        'scale' => 'required',
        'pendulum_effect' => 'required',
        //'link' => 'required',
        //'link_marker' => 'required',
        'attack' => 'required',
        'defense' => 'required',

    );


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterCardDetail extends Model
{
    //protected $fillable = ['card_master_id'];
    //
    public static function getRules($classIdArr)//$classId
    {

        $rules = array(
            'property' => 'required',//属性
            'tribe_id' => 'required',//種族
            'level_rank_link' => 'required', //レベル,ランク、リンク
            'attack' => 'required',//攻撃力
            'defense' => 'required',//守備力
        );

        $classIdSearch = array_search('12',$classIdArr);//class_idの連想配列内にペンデュラム:12
            if ( $classIdSearch !== false ) {
                $rules += array(
                    'scale' => 'required', 'pendulum_effect' => 'required',
                );
            }

        $classIdSearch1 = array_search('14',$classIdArr);//class_idの連想配列内にリンク:14
            if ( $classIdSearch1 !== false ) {
              $rules += array(
                  'link_marker' => 'required',

              );
              unset($rules['defense']);
            }

          return $rules;
      }
}






/*
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
*/

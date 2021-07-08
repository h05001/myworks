<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonsterCardDetail extends Model
{
    //
    public static function getRules($classIdArr)
    {
        $rules = array(
            'property' => 'required',//属性
            'tribe' => 'required',//種族
            'attack' => 'required',//攻撃力
        );

      foreach ($classIdArr as $classId){
        //効果かつエクシーズかつペンデュラム
        if($classId == "1" && $classId == "5" && $classId == "12"){
          $rules += array(
              'rank' => 'required', 'scale' => 'required', 'pendulum_effect' => 'required', 'defense' => 'required',
        );


        }else{

        switch($classId){
          case "0"://通常
          case "1"://効果
          case "2"://儀式
          case "3"://融合
          case "4"://シンクロ
          case "6"://トゥーン
          case "7"://スピリット
          case "8"://ユニオン
          case "9"://デュアル
          case "10"://チューナー
          case "11"://リバース
          case "13"://特殊召喚
              $rules += array(
                  'level' => 'required', 'defense' => 'required',
              );
              break;
          case "5"://エクシーズ
              $rules += array(
                  'rank' => 'required', 'defense' => 'required',
              );
              break;

          case "12"://ペンデュラム
              $rules += array(
                  'leval' => 'required', 'scale' => 'required', 'pendulum_effect' => 'required', 'defense' => 'required',
              );
              break;

          case "14"://リンク
              $rules += array(
                  'link' => 'required', 'link_marker' => 'required',
              );
              break;

        }
      }
      return $rules;
    }
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    //
    protected $guarded = array('card_master_id');
    protected $primaryKey = 'card_master_id';
    // 以下を追記
    public static $rules = array(
        //'id' => 'required',
        'card_name' => 'required',
        'ruby' => 'required',
        'card_class' => 'required',

        'card_text' => 'required',
    );


    // CardDetail Modelに関連付けを行う
    public function monstercarddetails()
    {
      return $this->hasone('App\MonsterCardDetail', 'card_master_id');

    }

    /*public function monstercardclasses()
    {
      return $this->hasManyThrough('App\MonsterClassMaster',
                                   'App\MonsterCardClass',
                                   'class_id',
                                   'id',
                                   'card_master_id',
                                   'card_master_id');
      //return $this->hasMany('App\MonsterCardClass','App\MonsterClassMaster','id');
    }*/

    public function monstercardclasses()
    {
      return $this->hasManyThrough('App\MonsterClassMaster',
                                   'App\MonsterCardClass',
                                   'card_master_id',
                                   'id',
                                   null,
                                   'class_id');
    }

    public function magiccarddetails()
    {
      return $this->hasone('App\MagicCardDetail', 'card_master_id');

    }

    public function trapcarddetails()
    {
        return $this->hasOne('App\trapCardDetail', 'card_master_id');
    }

}

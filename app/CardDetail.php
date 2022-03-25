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


    public function monstercardclasses()
    {
      return $this->hasManyThrough('App\MonsterClassMaster',
                                   'App\MonsterCardClass',
                                   'card_master_id',
                                   'id',
                                   null,
                                   'class_id');
    }

    public function tribemasters()
    {
      return $this->hasManyThrough('App\Tribe',
                                   'App\MonsterCardDetail',
                                   'card_master_id',
                                   'tribe_id',
                                   'card_master_id',
                                   'tribe_id');

    }


    public function magiccarddetails()
    {
      return $this->hasone('App\MagicCardDetail', 'card_master_id');

    }

    public function trapcarddetails()
    {
        return $this->hasOne('App\TrapCardDetail', 'card_master_id');
    }

    public function cardprices()
    {
        return $this->hasManyThrough('App\CardPrice',
                                     'App\RecordingCard',
                                     'card_master_id',
                                     'recordingcard_id',
                                     'card_master_id',
                                     'id');
    }

}

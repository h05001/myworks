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
      return $this->hasMany('App\MonsterCardDetail');

    }

    public function monstercardclasses()
    {
      return $this->hasMany('App\MonsterCardClass');

    }

    public function magiccarddetails()
    {
      return $this->hasMany('App\MagicCardDetail');

    }

    public function trapcarddetails()
    {
      return $this->hasMany('App\trapCardDetail');

    }

}

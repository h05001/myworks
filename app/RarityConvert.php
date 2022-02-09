<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RarityConvert extends Model
{
    //
    protected $guarded = array('id');
    //
    public static $rules = array(

      'shop_id' => 'required',//ショップID
      'rarity_id' => 'required',//レアリティID
      'rarity_convert' => 'required',//ショップ毎のレアリティ名
    );
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardPrice extends Model
{
    //
    protected $fillable = ['cardshop_id','recordingcard_id','rarity_convert','cardprice'];

    public static $rules = array(
        'cardshop_id' => 'required',
        'recordingcard_id' => 'required',
        'rarity_id' => 'required',
        'cardprice' => 'required',
    );

}

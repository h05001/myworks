<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    //
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        //'id' => 'required',
        'card_name' => 'required',
        'ruby' => 'required',
        'card_class' => 'required',
        
        'card_text' => 'required',
    );
}

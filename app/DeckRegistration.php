<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeckRegistration extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
        //'id' => 'required',
        'deck_id' => 'required',
        'kinds' => 'required',
        'card_name' => 'required',
        'card_master_id' => 'required',
        'number' => 'required',
    );
}

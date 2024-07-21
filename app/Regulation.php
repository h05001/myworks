<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regulation extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
        'regulation_id' => 'required',
        'card_master_id' => 'required',
        'card_name' => 'required',
        'able' => 'required | integer',

    );

}

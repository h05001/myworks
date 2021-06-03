<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrapCardDetail extends Model
{
    //
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        //'card_master_id' => 'required',
        'trap_card_class' => 'required',

    );
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MagicCardDetail extends Model
{
    //
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'card_master_id' => 'required',
        'magic_card_class' => 'required',

    );
}

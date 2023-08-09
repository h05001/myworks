<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentDeckCard extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
        //'id' => 'required',
        'tounament_deck_id' => 'required',
        'kinds' => 'required',
        'card_name' => 'required',
        //'card_master_id' => 'required',
        'card_class' => 'required',
        'number' => 'required',
    );
}

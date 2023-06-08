<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentDeck extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
        //'id' => 'required',
        'tournament_id' => 'required',
        'deck_name' => 'required',
        'rank' => 'required',

    );
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordingCard extends Model
{
    //
    protected $fillable = ['cardname','recordingpackid','recordingcardid','rarity'];

    public static $rules = array(
        'cardname' => 'required',
        'recordingpackid' => 'required',
        'recordingcardid' => 'required',
        'rarity' => 'required',
    );
}

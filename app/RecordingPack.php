<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordingPack extends Model
{
    //
    protected $fillable = ['recordingpack','recordingpackid'];
    
    public static $rules = array(
        'recordingpack' => 'required',
        'recordingpackid' => 'required',
    );

}

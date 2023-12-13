<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordingPack extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
        'recordingpack' => 'required',
        'recordingpackid' => 'required',
        'category' => 'required | integer',

    );

}

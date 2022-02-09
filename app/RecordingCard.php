<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordingCard extends Model
{
    //
    protected $fillable = ['cardname','card_master_id','recordingpackid','recordingcardid','rarity_id'];

    public static $rules = array(
        'cardname' => 'required',
        'card_master_id' => 'required',
        'recordingpackid' => 'required',
        'recordingcardid' => 'required',
        'rarity_id' => 'required',
    );

    public function rarity()
    {
      //return $this->hasone('App\rarity', 'id');
      return $this->hasone('App\rarity');
    }

}

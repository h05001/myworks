<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
    protected $guarded = array('id');
    //
    public static $rules = array(

      'rarity_jp' => 'required',//レアリティ
      'rarity_en' => 'required',//rarity
    );



}

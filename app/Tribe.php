<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tribe extends Model
{
    protected $guarded = array('card_master_id');
    //
    public static $rules = array(

      'tribe' => 'required',//種族

    );

}

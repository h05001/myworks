<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    //
    protected $guarded = array('id');
    protected $fillable = ['tournament_name','date'];
    //protected $table = 'tournament';

    public static $rules = array(
        //'id' => 'required',
        'tournament_name' => 'required',
        'date' => 'required',

    );
}

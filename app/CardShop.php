<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardShop extends Model
{
    //
    protected $fillable = ['cardshop','URL'];
    
    public static $rules = array(
        'cardshop' => 'required',
        'URL' => 'required',
    );

}

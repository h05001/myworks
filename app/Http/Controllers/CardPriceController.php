<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CardPrice;
use DB;

class CardPriceController extends Controller



{
  $host = '127.0.0.1';
  $username = 'h05001';
  $password = 'hiroyuki';


    $mysqli = new mysqli($host, $username, $password);
    //
    $sql = DB::select("SELECT * FROM cardshops");
    return view('cardprice.index',['shopname' => $shopname]);




}

?>

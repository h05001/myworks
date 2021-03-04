<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CardPrice;


class CardPriceController extends Controller

{
  public function index()
  {


    //
    $sql = DB::select("SELECT * FROM card_shops");
    return view('cardprice.index',['cardprice_form' => $sql]);
  }



}

?>

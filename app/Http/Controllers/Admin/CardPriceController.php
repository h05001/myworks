<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardPriceController extends Controller
{
    //
    public function add()
  {
      return view('admin.cardprice.create');
  }

    public function create(Request $request)
  {
    // Varidationを行う
          $this->validate($request, CardPrice::$rules);



      return redirect('admin/cardprice/create');
  }

  public function index(Request $request)
    {

        $posts = CardPrice::all();

        return view('admin.cardprice.index', ['posts' => $posts]);
    }
    public function edit()
  {
      return view('admin.cardprice.edit');
  }

    public function update()
  {
      return redirect('admin/cardprice/edit');
  }

}

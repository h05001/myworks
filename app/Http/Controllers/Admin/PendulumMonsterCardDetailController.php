<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PendulumMonsterCardDetailController extends Controller
{
    //
    public function add()
  {
      return view('admin.pendulummonstercarddetail.create');
  }


    public function create(Request $request)
  {
      return redirect('admin/pendulummonstercarddetail/create');
  }

    public function edit()
  {
      return view('admin.pendulummonstercarddetail.edit');
  }

    public function update()
  {
      return redirect('admin/pendulummonstercarddetail/edit');
  }
}

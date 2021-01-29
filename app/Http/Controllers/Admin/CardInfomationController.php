<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardInfomationController extends Controller
{
    //
    public function add()
  {
      return view('admin.cardinfomation.create');
  }


    public function create(Request $request)
  {
      return redirect('admin/cardinfomation/create');
  }

    public function edit()
  {
      return view('admin.cardinfomation.edit');
  }

    public function update()
  {
      return redirect('admin/cardinfomation/edit');
  }
}

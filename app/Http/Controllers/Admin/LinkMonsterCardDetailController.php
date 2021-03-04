<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkMonsterCardDetailController extends Controller
{
    //
    public function add()
  {
      return view('admin.linkmonstercarddetail.create');
  }


    public function create(Request $request)
  {
      return redirect('admin/linkmonstercarddetail/create');
  }

    public function edit()
  {
      return view('admin.linkmonstercarddetail.edit');
  }

    public function update()
  {
      return redirect('admin/linkmonstercarddetail/edit');
  }
}

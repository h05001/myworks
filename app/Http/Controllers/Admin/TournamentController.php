<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TournamentController extends Controller
{

  public function add()
  {

      return view('admin.tournament.create');

  }

  public function create(Request $request)
  {




      return redirect('admin/tournament/create');
  }
}

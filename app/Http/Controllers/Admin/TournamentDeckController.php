<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TournamentDeckController extends Controller
{
  public function add()
  {

      return view('admin.tournamentDeck.create');

  }

  public function create(Request $request)
  {





      return redirect('admin/tournamentDeck/create');
  }
}

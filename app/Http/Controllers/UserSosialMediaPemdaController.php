<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;

class UserSosialMediaPemdaController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index($id) {
      $pemda = listPemdaModel::where('_id', (int)$id)->first();

      return view('edit_sosmed', ['pemda' => $pemda]);
  }

  public function update(Request $request, $id) {
    $pemda = listPemdaModel::where('_id', (int)$id)->first();

    $pemda->name = $request->name;
    $pemda->youtube_resmi = $request->youtube_resmi;
    $pemda->twitter_resmi = $request->twitter_resmi;
    $pemda->facebook_resmi = $request->facebook_resmi;

    $pemda->save();

    return redirect()->route('kategorisasi', ['id' => $pemda->_id]);
  }
}

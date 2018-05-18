<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\userModel;
use App\Model\dinasModel;
use App\Model\listPemdaModel;

class PemdaController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function index() {
    $users = userModel::all();
    return view('admin/pemda', ['users' => $users]);
  }

  public function update(Request $request, $id) {
    $user = userModel::find($id);

    $user->name = $request->name;
    $user->email = $request->email;

    $user->save();

    $users = userModel::all();

    return view('admin/pemda', ['users' => $users]);
  }

  public function destroy($id, $idDinas) {
    $user = userModel::find($id);
    $dinases = $user->dinas->where('_id', $idDinas)->first();
    $dinases->delete();
    $dinases = $user->dinas;

    return redirect()->route('admin/dinas', ['user' => $user]);
  }


  public function edit($id) {
    $user = userModel::find($id);
    $pemdas = listPemdaModel::all();
    return view('admin/edit_pemda', ['user' => $user, 'pemdas' => $pemdas]);
  }

  public function showDinas($id) {
    $user = userModel::find($id);
    $dinases = $user->dinas;
    return view('admin/pemda-dinas', ['dinases' => $dinases, 'user' => $user]);
  }
}

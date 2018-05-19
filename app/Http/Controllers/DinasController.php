<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\userModel;
use App\Model\dinasModel;

class DinasController extends Controller
{
  public function index($id) {
    $user = userModel::find($id);
    $dinases = $user->dinas;
    return view('dinas', ['dinases' => $dinases, 'user' => $user]);
  }

  public function store(Request $request) {
    $user = userModel::where('_id', $request->id_pemda)->first();

    $idDinas = new \MongoDB\BSON\ObjectID();
    $dinas = new dinasModel;
    $dinas->_id = $idDinas;
    $dinas->idUser = $user->_id;
    $dinas->nama_dinas = $request->nama_dinas;
    $dinas->deskripsi_dinas = $request->deskripsi_dinas;
    $dinas->keyword = $request->keyword_dinas;
    $dinas->save();

    $dinases = $user->dinas;

    return view('dinas', ['dinases' => $dinases, 'user' => $user]);
  }

  public function update(Request $request, $id) {
    $user = userModel::find($id);
    $dinases = $user->dinas->where('_id', $request->id_dinas)->first();

    $dinases->nama_dinas = $request->nama_dinas;
    $dinases->deskripsi_dinas = $request->deskripsi_dinas;
    $dinases->keyword = $request->keyword_dinas;

    $dinases->save();

    $dinases = $user->dinas;

    return view('dinas', ['dinases' => $dinases, 'user' => $user]);
  }

public function destroy($id, $idDinas) {
  $user = userModel::find($id);
  $dinases = $user->dinas->where('_id', $idDinas)->first();
  $dinases->delete();
  $dinases = $user->dinas;

  return redirect()->route('dinas', ['user' => $user]);
}


  public function showTambahDinas() {
    return view('auth.register_dinas');
  }

  public function edit($id, $idDinas) {
    $user = userModel::find($id);
    $dinases = $user->dinas->where('_id', $idDinas);
    return view('edit_dinas', ['dinases' => $dinases, 'user' => $user]);
  }
}

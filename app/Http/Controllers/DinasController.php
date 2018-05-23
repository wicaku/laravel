<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\userModel;
use App\Model\dinasModel;
use App\Model\listPemdaModel;

class DinasController extends Controller
{
  public function index($id) {
    $user = userModel::where('idPemda', $id)->first();
    $dinases = $user->dinas;
    $pemda = listPemdaModel::where('_id', (int)$id)->first();
    return view('dinas', ['dinases' => $dinases, 'user' => $user, 'pemda' => $pemda]);
  }

  public function store(Request $request) {
    $user = userModel::where('idPemda', $request->id_pemda)->first();

    $idDinas = new \MongoDB\BSON\ObjectID();
    $dinas = new dinasModel;
    $dinas->_id = $idDinas;
    $dinas->idUser = $user->_id;
    $dinas->nama_dinas = $request->nama_dinas;
    $dinas->deskripsi_dinas = $request->deskripsi_dinas;
    $dinas->keyword = $request->keyword_dinas;
    $dinas->save();

    $dinases = $user->dinas;
    $pemda = listPemdaModel::where('_id', (int)$request->id_pemda)->first();
    return view('dinas', ['dinases' => $dinases, 'user' => $user, 'pemda' => $pemda]);
  }

  public function update(Request $request, $id) {
    $user = userModel::where('idPemda', $id)->first();
    $dinases = $user->dinas->where('_id', $request->id_dinas)->first();

    $dinases->nama_dinas = $request->nama_dinas;
    $dinases->deskripsi_dinas = $request->deskripsi_dinas;
    $dinases->keyword = $request->keyword_dinas;

    $dinases->save();

    $dinases = $user->dinas;
    $pemda = listPemdaModel::where('_id', (int)$id)->first();

    return view('dinas', ['dinases' => $dinases, 'user' => $user, 'pemda' => $pemda]);
  }

public function destroy($id, $idDinas) {
  $user = userModel::where('idPemda', $id)->first();
  $dinases = $user->dinas->where('_id', $idDinas)->first();
  $dinases->delete();
  $dinases = $user->dinas;
  $pemda = listPemdaModel::where('_id', (int)$id)->first();

  return redirect()->route('dinas', ['id' => $user->idPemda]);
}


  public function showTambahDinas() {
    return view('auth.register_dinas');
  }

  public function edit($id, $idDinas) {
    $user = userModel::where('idPemda', $id)->first();
    $dinases = $user->dinas->where('_id', $idDinas);
    return view('edit_dinas', ['dinases' => $dinases, 'user' => $user]);
  }
}

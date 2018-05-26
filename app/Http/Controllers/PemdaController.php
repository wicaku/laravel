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

  public function showDeleted() {
    $users = userModel::onlyTrashed()->get();
    return view('admin/pemda-deleted', ['users' => $users]);
  }

  public function restore($id) {
    $users = userModel::onlyTrashed()->where('_id', $id)->restore();
    $users = userModel::onlyTrashed()->get();
    return view('admin/pemda-deleted', ['users' => $users]);
  }

  public function forceDeleted($id) {
    $users = userModel::onlyTrashed()->where('_id', $id)->forceDelete();
    $users = userModel::onlyTrashed()->get();
    return view('admin/pemda-deleted', ['users' => $users]);
  }

  public function update(Request $request, $id) {
    $user = userModel::where('idPemda', (int)$id)->first();

    $user->email = $request->email;

    $user->save();

    $users = userModel::all();

    return view('admin/pemda', ['users' => $users]);
  }

  public function destroy($id) {
    $user = userModel::find($id);
    $user->delete();

    return redirect()->route('pemda');
  }


  public function edit($id) {
    $user = userModel::where('idPemda', (int)$id)->first();
    $pemdas = listPemdaModel::all();
    $userName = listPemdaModel::find((int)$id);

    return view('admin/edit_pemda', ['user' => $user, 'pemdas' => $pemdas, 'userName' => $userName]);
  }

  public function showDinas($id) {
    $user = userModel::where('idPemda', (int)$id)->first();
    $dinases = $user->dinas;
    return view('admin/pemda-dinas', ['dinases' => $dinases, 'user' => $user]);
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

    return view('admin/pemda-dinas', ['dinases' => $dinases, 'user' => $user]);
  }

  public function updateDinas(Request $request, $id) {
    $user = userModel::find($id);
    $dinases = $user->dinas->where('_id', $request->id_dinas)->first();

    $dinases->nama_dinas = $request->nama_dinas;
    $dinases->deskripsi_dinas = $request->deskripsi_dinas;
    $dinases->keyword = $request->keyword_dinas;

    $dinases->save();

    $dinases = $user->dinas;

    return view('admin/pemda-dinas', ['dinases' => $dinases, 'user' => $user]);
  }

  public function editDinas($id, $idDinas) {
    $user = userModel::find($id);
    $dinases = $user->dinas->where('_id', $idDinas);
    return view('admin/pemda_edit_dinas', ['dinases' => $dinases, 'user' => $user]);
  }

  public function destroyDinas($id, $idDinas) {
    $user = userModel::find($id);
    $dinases = $user->dinas->where('_id', $idDinas)->first();
    $dinases->delete();
    $dinases = $user->dinas;

    return redirect()->route('pemda.dinas', ['user' => $user]);
  }
}

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
    return view('dinas', ['dinases' => $dinases]);
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
    // $user->push('dinas', ['id_dinas' => $idDinas]);

    $dinases = $user->dinas;

    return view('dinas', ['dinases' => $dinases]);
  }

  public function update(Request $request, $id) {
    // dd($request->all());
    $user = userModel::find($id);
    // dd($user);
    $dinases = $user->dinas->where('_id', $request->id_dinas)->first();

    $dinases->nama_dinas = $request->nama_dinas;
    $dinases->deskripsi_dinas = $request->deskripsi_dinas;
    $dinases->keyword = $request->keyword_dinas;

    $dinases->save();

    $dinases = $user->dinas;

    return view('dinas', ['dinases' => $dinases]);

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
    // $dinases = userModel::where('_id', $id)->first();
    // // $dinas = userModel::where('dinas.id_dinas', "5aeffdb80e006205640052ff_5af010390e00620564005308")->get();
    // // $dinas = userModel::where('dinas', 'elemMatch', ['id_dinas' => "5aeffdb80e006205640052ff_5af010390e00620564005308"])->get();
    // // $dinas = userModel::where({'dinas.id': '$idDinas'}, {'dinas': { $elemMatch: { 'id': $idDinas}}})->get();
    // // $dinas = userModel::where('dinas' , 'elemMatch', array('_id' => $idDinas))->first();
    //
    // // $dinas = dinasModel::where('id', "5aeffdb80e006205640052ff_5af010390e00620564005308")->get();
    // // $dinas = userModel::first()->dinas->where('dinas.id', $idDinas)->get();
    // $dinas = $dinases->dinas()->get()->where('id', $idDinas);
    // // $cariDinas = $dinas->where('dinas.id', $idDinas)->get();
    // // dd($dinas);
    $user = userModel::find($id);
    $dinases = $user->dinas->where('_id', $idDinas);
    return view('edit_dinas', ['dinases' => $dinases]);
  }
}

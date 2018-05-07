<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\userModel;

class DinasController extends Controller
{
  public function index($id) {
    $dinases = userModel::where('_id', $id)->get();
    return view('dinas', ['dinases' => $dinases]);
  }

  public function store(Request $request) {
    $dinas = userModel::where('_id', $request->id_pemda)->first();
    $idDinas = new \MongoDB\BSON\ObjectID();
    $newIdDinas = "{$request->id_pemda}_{$idDinas}";
    // dd($newIdDinas);
    $dinas->push('dinas', ['id_dinas' => $newIdDinas,'nama_dinas' => $request->nama_dinas, 'deskripsi_dinas' => $request->deskripsi_dinas, 'keyword' => $request->keyword_dinas]);

    $dinases = userModel::where('_id', $request->id_pemda)->get();
    return view('dinas', ['dinases' => $dinases]);
  }

}

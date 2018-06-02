<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\userModel;
use App\Model\dinasModel;
use App\Model\listPemdaModel;


class RekomendasiController extends Controller
{
  public function index($id) {
    $user = userModel::where('idPemda', (int)$id)->first();
    $dinases = $user->dinas;
    $pemda = listPemdaModel::where('_id', (int)$id)->first();
    return view('rekomendasi', ['dinases' => $dinases, 'user' => $user, 'pemda' => $pemda]);
  }

  public function tambahRekomendasi($id, $idDinas) {
    $user = userModel::where('idPemda', (int)$id)->first();
    $dinases = $user->dinas->where('_id', $idDinas)->first();

    if ($dinases->rekomendasi) {
        $dinases->keyword = $dinases->keyword.', '.$dinases->rekomendasi;
        $dinases->rekomendasi = null;
    } else {
        $dinases->keyword = $dinases->keyword;
    }

    $dinases->save();

    return redirect()->route('rekomendasi', ['id' => $user->idPemda]);
  }

  public function hapusRekomendasi($id, $idDinas) {
    $user = userModel::where('idPemda', (int)$id)->first();
    $dinases = $user->dinas->where('_id', $idDinas)->first();

    $dinases->rekomendasi = null;

    $dinases->save();

    return redirect()->route('rekomendasi', ['id' => $user->idPemda]);
  }
}

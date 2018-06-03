<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;

class SosialMediaPemdaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() {
        $pemdas = listPemdaModel::all();
        return view('admin/sosmed', ['pemdas' => $pemdas]);
    }

    public function edit($id) {
      $pemda = listPemdaModel::where('_id', (int)$id)->first();

      return view('admin/edit_sosmed', ['pemda' => $pemda]);
    }

    public function update(Request $request, $id) {
      $pemda = listPemdaModel::where('_id', (int)$id)->first();

      $pemda->name = $request->name;
      $pemda->youtube_resmi = $request->youtube_resmi;
      $pemda->youtube_influencer = $request->youtube_influencer;
      $pemda->twitter_resmi = $request->twitter_resmi;
      $pemda->twitter_resmi_number = $request->twitter_resmi_number;
      $pemda->twitter_influencer = $request->twitter_influencer;
      $pemda->facebook_resmi = $request->facebook_resmi;
      $pemda->facebook_influencer = $request->facebook_influencer;

      $pemda->save();

      $pemdas = listPemdaModel::all();

      return redirect()->route('sosmed.pemda');
    }

    public function destroy($id) {
      $pemda = listPemdaModel::where('_id', (int)$id)->first();
      $pemda->delete();

      return redirect()->route('sosmed.pemda');
    }

    public function store(Request $request) {
      $pemdas = count(listPemdaModel::all());

      $pemda = new listPemdaModel;

      $pemda->_id = $pemdas+1;
      $pemda->name = $request->name;
      $pemda->youtube_resmi = $request->youtube_resmi;
      $pemda->youtube_influencer = $request->youtube_influencer;
      $pemda->twitter_resmi = $request->twitter_resmi;
      $pemda->twitter_resmi_number = $request->twitter_resmi_number;
      $pemda->twitter_influencer = $request->twitter_influencer;
      $pemda->facebook_resmi = $request->facebook_resmi;
      $pemda->facebook_influencer = $request->facebook_influencer;

      $pemda->save();

      return redirect()->route('sosmed.pemda');
    }

    public function showDeleted() {
      $pemdas = listPemdaModel::onlyTrashed()->get();
      return view('admin/sosmed-deleted', ['pemdas' => $pemdas]);
    }

    public function restore($id) {
      $pemdas = listPemdaModel::onlyTrashed()->where('_id', (int)$id)->restore();
      $pemdas = listPemdaModel::onlyTrashed()->get();
      return view('admin/sosmed-deleted', ['pemdas' => $pemdas]);
    }

    public function forceDeleted($id) {
      $users = listPemdaModel::onlyTrashed()->where('_id', (int)$id)->forceDelete();
      $users = listPemdaModel::onlyTrashed()->get();
      return view('admin/sosmed-deleted', ['pemdas' => $pemdas]);
    }
}

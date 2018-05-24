<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\userModel;
use App\Model\dinasModel;
use App\Model\listPemdaModel;

class AdminVerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $pemdas = listPemdaModel::all();
      // // dd($pemdas[0]['name']);
      // foreach($pemdas as $pemda) {
      //   $users[] = $pemda->user;
      // }
      //
      // dd($pemdas);
      //
      // foreach($users as $user) {
      //   if (!empty($user)) {
      //     $newUser[] = $user->where('verified', false)->get();
      //   }
      // }

      $users = userModel::where('verified', false)->get();

      // dd($pemdas);

      return view('admin/verifikasi', ['users' => $users ]);
    }
}

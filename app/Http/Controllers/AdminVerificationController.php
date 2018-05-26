<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\userModel;
use App\Model\dinasModel;
use App\Model\listPemdaModel;

use App\Http\Controllers\Controller;
use App\Mail\VerifiedEmail;
use Illuminate\Support\Facades\Mail;

use App\Notifications\UserVerified;
use App\Notifications\UserRejected;

class AdminVerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redirectTo = '/kategorisasi-admin/verifikasi';
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
      $users = userModel::where('verified', false)->get();

      return view('admin/verifikasi', ['users' => $users ]);
    }

    public function verified($id)
    {
      $user = userModel::where('idPemda', (int)$id)->first();

      $user->verified = true;
      $user->save();

      $pemda = listPemdaModel::where('_id', (int)$id)->first();

      $objDemo = new \stdClass();
      $objDemo->sender = 'Egovbench ADDI ITS';
      $objDemo->receiver = $pemda->name;

      $objDemo->link = 'http://egovbench.addi.is.its.ac.id/';

      $user->notify(new UserVerified($user));

      $users = userModel::where('verified', false)->get();

      return redirect()->route('admin.verifikasi');
    }

    public function rejected($id)
    {
      $user = userModel::where('idPemda', (int)$id)->first();

      $objDemo = new \stdClass();
      $objDemo->sender = 'Egovbench ADDI ITS';


      $objDemo->link = 'http://egovbench.addi.is.its.ac.id/';

      $user->notify(new UserRejected($user));

      $user->forceDelete();

      return redirect()->route('admin.verifikasi');
    }
}

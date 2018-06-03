<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;
use App\Model\dinasModel;
use App\Model\twitter_replyModel;
use App\Model\facebookAccountsModel;

class KategorisasiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $pemda = listPemdaModel::where('_id', (int)$id)->first();
      $dinases = dinasModel::where('idPemda', (int)$id)->get();
      $facebook_resmi = facebookAccountsModel::where('pemda_id', (int)$id)->get(['result.category']);
      // $facebook_resmi = facebookAccountsModel::where('pemda_id', (int)$id)->sum('result.category.Dinas abc');

      // dd($facebook_resmi);

      foreach($facebook_resmi as $fr) {
        $namaDinasArray[] = $fr['result.category'];
      }

      // dd($namaDinasArray);

      foreach($namaDinasArray[0] as $nama => $value) {
        $namaDinas[] = $nama;
        $valueDinas[] = $value;
        // $total[$nama] = facebookAccountsModel::where('pemda_id', (int)$id)->groupBy('pemda_id')->sum('result.category.[$namaDinas]');
      }




      $chartArray ["chart"] = array (
          "type" => "column"
      );
      $chartArray ["title"] = array (
          "text" => "Jumlah Komentar Facebook Resmi"
      );
      $chartArray ["credits"] = array (
          "enabled" => true
      );

      $chartArray ["xAxis"] = array (
          "categories" =>[""]
      );

      $chartArray ["tooltip"] = array (
          "valueSuffix" => " Komentar"
      );

      $chartArray ["yAxis"] = array (
          "min" => 0,
          "title" => [
              "text" => 'Komentar'
          ]
      );

      for($i = 0; $i < count ( $valueDinas ); $i ++)
			   $chartArray ["series"] [] = array (
                "name" => $namaDinas [$i],
					      "data" => [$valueDinas [$i]]
			   );

      return view('kategorisasi', ['pemda' => $pemda, 'dinases' => $dinases])->withChartArray($chartArray);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;
use App\Model\dinasModel;
use App\Model\twitter_replyModel;
use App\Model\facebookCommentsModel;
use App\Model\youtubeCommentsModel;
use App\Model\userModel;

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
      $namaDinas = [];
      $jumlahKomentarFacebookResmi = [];
      $jumlahKomentarFacebookInfluencer = [];
      $jumlahKomentarTwitterResmi = [];
      $jumlahKomentarTwitterInfluencer = [];
      $jumlahKomentarYoutubeResmi = [];
      $jumlahKomentarYoutubeInfluencer = [];

      //facebook resmi
      $komentarFacebookResmi = facebookCommentsModel::where('page_id', $pemda->facebook_resmi)->get();
      //facebook influencer
      $komentarFacebookInfluencer = facebookCommentsModel::where('page_id', $pemda->facebook_influencer)->get();
      //twitter resmi
      $komentarTwitterResmi = twitter_replyModel::where('account_id', $pemda->twitter_resmi)->get();
      //twitter influencer
      $komentarTwitterInfluencer = twitter_replyModel::where('account_id', $pemda->twitter_influencer)->get();
      //youtube resmi
      $komentarYoutubeResmi = youtubeCommentsModel::where('channel_id', $pemda->youtube_resmi)->get();
      //youtube influencer
      $komentarYoutubeInfluencer = youtubeCommentsModel::where('channel_id', $pemda->youtube_influencer)->get();

      foreach($dinases as $dinas) {
        $namaDinas[] = $dinas['nama_dinas'];
        $dinas['facebook_resmi'] = $komentarFacebookResmi->where('category', $dinas['nama_dinas'])->count();
        $dinas['facebook_influencer'] = $komentarFacebookInfluencer->where('category', $dinas['nama_dinas'])->count();
        $dinas['twitter_resmi'] = $komentarTwitterResmi->where('category', $dinas['nama_dinas'])->count();
        $dinas['twitter_influencer'] = $komentarTwitterInfluencer->where('category', $dinas['nama_dinas'])->count();
        $dinas['youtube_resmi'] = $komentarYoutubeResmi->where('category', $dinas['nama_dinas'])->count();
        $dinas['youtube_influencer'] = $komentarYoutubeInfluencer->where('category', $dinas['nama_dinas'])->count();
        $dinas['total_komentar'] = $dinas['facebook_resmi'] + $dinas['facebook_influencer'] + $dinas['twitter_resmi'] + $dinas['twitter_influencer'] + $dinas['youtube_resmi'] + $dinas['youtube_influencer'];
      }

      $top5dinas = $dinases->sortByDesc('total_komentar')->take(5);

      foreach($top5dinas as $td) {
        $namaDinas[] = $td['nama_dinas'];
        $jumlahKomentarFacebookResmi[] = $komentarFacebookResmi->where('category', $td['nama_dinas'])->count();
        $jumlahKomentarFacebookInfluencer[] = $komentarFacebookInfluencer->where('category', $td['nama_dinas'])->count();
        $jumlahKomentarTwitterResmi[] = $komentarTwitterResmi->where('category', $td['nama_dinas'])->count();
        $jumlahKomentarTwitterInfluencer[] = $komentarTwitterInfluencer->where('category', $td['nama_dinas'])->count();
        $jumlahKomentarYoutubeResmi[] = $komentarYoutubeResmi->where('category', $td['nama_dinas'])->count();
        $jumlahKomentarYoutubeInfluencer[] = $komentarYoutubeInfluencer->where('category', $td['nama_dinas'])->count();
      }


      $chartArray ["chart"] = array (
          "type" => "column"
      );
      $chartArray ["title"] = array (
          "text" => "Jumlah Kategorisasi Komentar"
      );
      $chartArray ["credits"] = array (
          "enabled" => true
      );

      for($i = 0; $i < count ( $namaDinas ); $i++) {
        $chartArray ["xAxis"][] = array (
               "categories" => $namaDinas
        );
      }

      $chartArray ["tooltip"] = array (
          "valueSuffix" => " Komentar"
      );

      $chartArray ["plotOptions"] = array (
          "column" => [
              "stacking" => 'normal',
              "dataLabels" => [
                'enabled' => true,
                'color' => 'white'
                ]
            ]

      );

      $chartArray ["yAxis"] = array (
          "min" => 0,
          "title" => [
              "text" => 'Komentar'
          ],
          "stackLabels" => [
              "enabled" => true
          ]
      );

	   $chartArray ["series"] [] = array (
            "name" => 'Facebook Resmi',
			      "data" => $jumlahKomentarFacebookResmi,
            "stack" => 'facebook'
	   );
     $chartArray ["series"] [] = array (
            "name" => 'Facebook Influencer',
			      "data" => $jumlahKomentarFacebookInfluencer,
            "stack" => 'facebook'
	   );
     $chartArray ["series"] [] = array (
            "name" => 'Twitter Resmi',
			      "data" => $jumlahKomentarTwitterResmi,
            "stack" => 'twitter'
	   );
     $chartArray ["series"] [] = array (
            "name" => 'Twitter Influencer',
			      "data" => $jumlahKomentarTwitterInfluencer,
            "stack" => 'twitter'
	   );
     $chartArray ["series"] [] = array (
            "name" => 'Youtube Resmi',
			      "data" => $jumlahKomentarYoutubeResmi,
            "stack" => 'youtube'
	   );
     $chartArray ["series"] [] = array (
            "name" => 'Youtube Influencer',
			      "data" => $jumlahKomentarYoutubeInfluencer,
            "stack" => 'youtube'
	   );


      return view('kategorisasi', ['pemda' => $pemda, 'dinases' => $dinases])->withChartArray($chartArray);
    }

    public function editAkun($id) {
      $user = userModel::where('idPemda', (int)$id)->first();
      $pemdas = listPemdaModel::all();
      $userName = listPemdaModel::find((int)$id);

      return view('edit_akun', ['user' => $user, 'pemdas' => $pemdas, 'userName' => $userName]);
    }

    public function updateAkun(Request $request, $id) {
      $user = userModel::where('idPemda', (int)$id)->first();

      $user->email = $request->email;

      $user->save();

      $users = userModel::all();

      return redirect()->route('kategorisasi', ['id' => $user->idPemda]);
    }
}

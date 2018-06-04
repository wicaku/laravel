<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;
use App\Model\dinasModel;
use App\Model\twitter_replyModel;
use App\Model\facebookAccountsModel;
use App\Model\facebookCommentsModel;
use App\Model\youtubeAccountsModel;
use App\Model\youtubeCommentsModel;

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

      //facebook resmi
      $komentarFacebookResmi = facebookCommentsModel::where('page_id', $pemda->facebook_resmi)->get();

      foreach($dinases as $dinas) {
        $namaDinas[] = $dinas['nama_dinas'];
      }

      foreach($dinases as $dinas) {
        $jumlahKomentarFacebookResmi[] = $komentarFacebookResmi->where('category', $dinas['nama_dinas'])->count();
      }

      //facebook influencer
      $komentarFacebookInfluencer = facebookCommentsModel::where('page_id', $pemda->facebook_influencer)->get();

      foreach($dinases as $dinas) {
        $jumlahKomentarFacebookInfluencer[] = $komentarFacebookInfluencer->where('category', $dinas['nama_dinas'])->count();
      }

      //twitter resmi
      $komentarTwitterResmi = twitter_replyModel::where('account_id', $pemda->twitter_resmi)->get();

      foreach($dinases as $dinas) {
        $jumlahKomentarTwitterResmi[] = $komentarTwitterResmi->where('category', $dinas['nama_dinas'])->count();
      }

      //twitter influencer
      $twitter_accounts_influencer = listPemdaModel::where('_id', (int)$id)->first();
      $komentarTwitterInfluencer = twitter_replyModel::where('account_id', $pemda->twitter_influencer)->get();

      foreach($dinases as $dinas) {
        $jumlahKomentarTwitterInfluencer[] = $komentarTwitterInfluencer->where('category', $dinas['nama_dinas'])->count();
      }

      //youtube resmi
      $komentarYoutubeResmi = youtubeCommentsModel::where('channel_id', $pemda->youtube_resmi)->get();

      foreach($dinases as $dinas) {
        $jumlahKomentarYoutubeResmi[] = $komentarYoutubeResmi->where('category', $dinas['nama_dinas'])->count();
      }

      //youtube influencer
      $komentarYoutubeInfluencer = youtubeCommentsModel::where('channel_id', $pemda->youtube_influencer)->get();

      foreach($dinases as $dinas) {
        $jumlahKomentarYoutubeInfluencer[] = $komentarYoutubeInfluencer->where('category', $dinas['nama_dinas'])->count();
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
}

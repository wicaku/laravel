<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;
use App\Model\dinasModel;
use App\Model\twitter_replyModel;
use App\Model\facebookCommentsModel;
use App\Model\youtubeCommentsModel;

class KlasifikasiKomentarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id) {
      $pemda = listPemdaModel::where('_id', (int)$id)->first();
      $dinases = dinasModel::where('idPemda', (int)$id)->get();

      $labelKlasifikasi = ['Berbagi Informasi', 'Meminta Informasi', 'Mengemukakan Pendapat', 'Apresiasi', 'Komplain Pelayanan'];

      //facebook resmi
      $komentarFacebookResmi = facebookCommentsModel::where('page_id', $pemda->facebook_resmi)->get();

      foreach($labelKlasifikasi as $lk) {
        $jumlahKomentarFacebookResmi[] = $komentarFacebookResmi->where('class', $lk)->count();
      }

      //facebook influencer
      $komentarFacebookInfluencer = facebookCommentsModel::where('page_id', $pemda->facebook_influencer)->get();

      foreach($labelKlasifikasi as $lk) {
        $jumlahKomentarFacebookInfluencer[] = $komentarFacebookInfluencer->where('class', $lk)->count();
      }

      //twitter resmi
      $komentarTwitterResmi = twitter_replyModel::where('account_id', $pemda->twitter_resmi)->get();

      foreach($labelKlasifikasi as $lk) {
        $jumlahKomentarTwitterResmi[] = $komentarTwitterResmi->where('class', $lk)->count();
      }

      //twitter influencer
      $komentarTwitterInfluencer = twitter_replyModel::where('account_id', $pemda->twitter_influencer)->get();

      foreach($labelKlasifikasi as $lk) {
        $jumlahKomentarTwitterInfluencer[] = $komentarTwitterInfluencer->where('class', $lk)->count();
      }

      //youtube resmi
      $komentarYoutubeResmi = youtubeCommentsModel::where('channel_id', $pemda->youtube_resmi)->get();

      foreach($labelKlasifikasi as $lk) {
        $jumlahKomentarYoutubeResmi[] = $komentarYoutubeResmi->where('class', $lk)->count();
      }

      //youtube influencer
      $komentarYoutubeInfluencer = youtubeCommentsModel::where('channel_id', $pemda->youtube_influencer)->get();

      foreach($labelKlasifikasi as $lk) {
        $jumlahKomentarYoutubeInfluencer[] = $komentarYoutubeInfluencer->where('class', $lk)->count();
      }

      $chartArray ["chart"] = array (
          "type" => "column"
      );
      $chartArray ["title"] = array (
          "text" => "Jumlah Klasifikasi Komentar"
      );
      $chartArray ["credits"] = array (
          "enabled" => true
      );

      for($i = 0; $i < count ( $labelKlasifikasi ); $i++) {
        $chartArray ["xAxis"][] = array (
               "categories" => $labelKlasifikasi
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

      return view('klasifikasiKomentar',['pemda' => $pemda, 'dinases' => $dinases])->withChartArray($chartArray);
    }
}

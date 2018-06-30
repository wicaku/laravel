<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;
use App\Model\dinasModel;
use App\Model\twitter_replyModel;
use App\Model\facebookCommentsModel;
use App\Model\youtubeCommentsModel;
use App\Model\facebookPostsModel;
use App\Model\twitterPostsModel;
use App\Model\youtubePostsModel;

class KlasifikasiController extends Controller
{
    public function index() {
      $pemdas = listPemdaModel::all();
      return view('klasifikasiKomentar',['pemdas' => $pemdas]);
    }

    public function klasifikasiKomentarPemda($id) {
      $pemda = listPemdaModel::where('_id', (int)$id)->first();

      $labelKlasifikasi = ['Berbagi Informasi', 'Meminta Informasi', 'Mengemukakan Pendapat', 'Apresiasi', 'Komplain Layanan Pemerintahan'];

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
      $komentarYoutubeResmi = youtubeCommentsModel::where('channel_id', strtolower($pemda->youtube_resmi))->get();

      foreach($labelKlasifikasi as $lk) {
        $jumlahKomentarYoutubeResmi[] = $komentarYoutubeResmi->where('class', $lk)->count();
      }

      //youtube influencer
      $komentarYoutubeInfluencer = youtubeCommentsModel::where('channel_id', strtolower($pemda->youtube_influencer))->get();

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

     for($i = 9; $i >= 0; $i --) {
       $tanggal[] = date('Y-m-d', strtotime('-'.$i.' days',  strtotime(date("Y-m-d"))));
     }

     foreach ($tanggal as $tgl) {
       $hitungKomenFBResmi[] = facebookCommentsModel::where('comment_createdDate', $tgl)->where('page_id', $pemda->facebook_resmi)->count();
       $hitungKomenTWResmi[] = twitter_replyModel::where('tweet_createdDate', $tgl)->where('account_id', $pemda->twitter_resmi)->count();
       $hitungKomenYTResmi[] = youtubeCommentsModel::where('comment_createdDate', $tgl)->where('channel_id', strtolower($pemda->youtube_resmi))->count();
       $hitungKomenFBInfluencer[] = facebookCommentsModel::where('comment_createdDate', $tgl)->where('page_id', $pemda->facebook_influencer)->count();
       $hitungKomenTWInfluencer[] = twitter_replyModel::where('tweet_createdDate', $tgl)->where('account_id', $pemda->twitter_influencer)->count();
       $hitungKomenYTInfluencer[] = youtubeCommentsModel::where('comment_createdDate', $tgl)->where('channel_id', strtolower($pemda->youtube_influencer))->count();
     }

      $chartArrayTotalKomen ["chart"] = array (
          "type" => "line"
      );
      $chartArrayTotalKomen ["title"] = array (
        "text" => "Jumlah Komentar yang Masuk 10 hari terakhir"
      );
      $chartArrayTotalKomen ["credits"] = array (
        "enabled" => true
      );

      for($i = 0; $i < count ( $tanggal ); $i++) {
      $chartArrayTotalKomen ["xAxis"][] = array (
      	   "categories" => $tanggal
      );
      }

      $chartArrayTotalKomen ["tooltip"] = array (
        "valueSuffix" => " Komentar"
      );

      $chartArrayTotalKomen ["plotOptions"] = array (
        "line" => [
      	  "dataLabels" => [
      		'enabled' => true,
      		'color' => 'black'
      		]
      	]
      );

      $chartArrayTotalKomen ["yAxis"] = array (
        "min" => 0,
        "title" => [
      	  "text" => 'Komentar'
        ],
        "stackLabels" => [
      	  "enabled" => true
        ]
      );

      $chartArrayTotalKomen ["series"] [] = array (
      	"name" => 'Facebook Resmi',
      		  "data" => $hitungKomenFBResmi,
      );
      $chartArrayTotalKomen ["series"] [] = array (
      	"name" => 'Twitter Resmi',
      		  "data" => $hitungKomenTWResmi,
      );
      $chartArrayTotalKomen ["series"] [] = array (
      	"name" => 'Youtube Resmi',
      		  "data" => $hitungKomenYTResmi,
      );
      $chartArrayTotalKomen ["series"] [] = array (
      	"name" => 'Facebook Influencer',
      		  "data" => $hitungKomenFBInfluencer,
      );
      $chartArrayTotalKomen ["series"] [] = array (
      	"name" => 'Twitter Influencer',
      		  "data" => $hitungKomenTWInfluencer,
      );
      $chartArrayTotalKomen ["series"] [] = array (
      	"name" => 'Youtube Resmi',
      		  "data" => $hitungKomenYTInfluencer,
      );

      return view('klasifikasiKomentarPemda',['pemda' => $pemda])->withChartArray($chartArray)->withChartArrayTotalKomen($chartArrayTotalKomen);
    }

    public function klasifikasiPostPemda($id) {
      $pemda = listPemdaModel::where('_id', (int)$id)->first();

      $labelKlasifikasiPost = ['Edukasi Warga', 'Informasi Layanan', 'Informasi Peristiwa', 'Permintaan Informasi Opini', 'Promosi Daerah', 'Pemberitahuan Pemeliharaan'];

      //facebook resmi
      $postFacebookResmi = facebookPostsModel::where('page_id', $pemda->facebook_resmi)->get();

      //twitter resmi
      $tweetTwitterResmi = twitter_replyModel::where('account_id', $pemda->twitter_resmi)->get();

      foreach($labelKlasifikasiPost as $lk) {
        $jumlahPostFacebookResmi[] = $postFacebookResmi->where('class', $lk)->count();
      }

      $namaPostTypeFacebook = ['link', 'photo', 'video', 'status', 'note', 'album'];
      $namaPostTypeTwitter = ['text', 'video', 'animated_gif', 'photo'];

      foreach($namaPostTypeFacebook as $nptf) {
        $jumlahTypePostFacebookResmi[] = $postFacebookResmi->where('post_type', $nptf)->count();
      }

      foreach($namaPostTypeTwitter as $nptt) {
        $jumlahTypeTweetTwitterResmi[] = $tweetTwitterResmi->where('tweet_type', $nptt)->count();
      }




      foreach($labelKlasifikasiPost as $lk) {
        $jumlahTweetTwitterResmi[] = $tweetTwitterResmi->where('class', $lk)->count();
      }

      //youtube resmi
      $postYoutubeResmi = youtubeCommentsModel::where('channel_id', strtolower($pemda->youtube_resmi))->get();

      foreach($labelKlasifikasiPost as $lk) {
        $jumlahPostYoutubeResmi[] = $postYoutubeResmi->where('class', $lk)->count();
      }

      $chartArrayTotalKlasifikasiPost ["chart"] = array (
        "type" => "column"
      );
      $chartArrayTotalKlasifikasiPost ["title"] = array (
        "text" => "Jumlah Klasifikasi Post"
      );
      $chartArrayTotalKlasifikasiPost ["credits"] = array (
        "enabled" => true
      );

      for($i = 0; $i < count ( $labelKlasifikasiPost ); $i++) {
      $chartArrayTotalKlasifikasiPost ["xAxis"][] = array (
      	   "categories" => $labelKlasifikasiPost
      );
      }

      $chartArrayTotalKlasifikasiPost ["tooltip"] = array (
        "valueSuffix" => " Post"
      );

      $chartArrayTotalKlasifikasiPost ["plotOptions"] = array (
        "column" => [
      	  "stacking" => 'normal',
      	  "dataLabels" => [
      		'enabled' => true,
      		'color' => 'white'
      		]
      	]

      );

      $chartArrayTotalKlasifikasiPost ["yAxis"] = array (
        "min" => 0,
        "title" => [
      	  "text" => 'Post'
        ],
        "stackLabels" => [
      	  "enabled" => true
        ]
      );

      $chartArrayTotalKlasifikasiPost ["series"] [] = array (
      	"name" => 'Facebook Resmi',
      		  "data" => $jumlahPostFacebookResmi,
      	"stack" => 'facebook'
      );

      $chartArrayTotalKlasifikasiPost ["series"] [] = array (
      	"name" => 'Twitter Resmi',
      		  "data" => $jumlahTweetTwitterResmi,
      	"stack" => 'twitter'
      );

      $chartArrayTotalKlasifikasiPost ["series"] [] = array (
      	"name" => 'Youtube Resmi',
      		  "data" => $jumlahPostYoutubeResmi,
      	"stack" => 'youtube'
      );


     for($i = 9; $i >= 0; $i --) {
       $tanggal[] = date('Y-m-d', strtotime('-'.$i.' days',  strtotime(date("Y-m-d"))));
     }

     foreach ($tanggal as $tgl) {
       $hitungPostFBResmi[] = facebookPostsModel::where('comment_createdDate', $tgl)->where('page_id', $pemda->facebook_resmi)->count();
       $hitungPostTWResmi[] = twitterPostsModel::where('tweet_createdDate', $tgl)->where('account_id', $pemda->twitter_resmi)->count();
       $hitungPostYTResmi[] = youtubePostsModel::where('comment_createdDate', $tgl)->where('channel_id', strtolower($pemda->youtube_resmi))->count();
     }

      $chartArrayTotalPost ["chart"] = array (
        "type" => "line"
      );
      $chartArrayTotalPost ["title"] = array (
        "text" => "Jumlah Post yang Masuk 10 hari terakhir"
      );
      $chartArrayTotalPost ["credits"] = array (
        "enabled" => true
      );

      for($i = 0; $i < count ( $tanggal ); $i++) {
        $chartArrayTotalPost ["xAxis"][] = array (
          "categories" => $tanggal
        );
      }

      $chartArrayTotalPost ["tooltip"] = array (
        "valueSuffix" => " Post"
      );

      $chartArrayTotalPost ["plotOptions"] = array (
        "line" => [
          "dataLabels" => [
            'enabled' => true,
            'color' => 'black'
            ]
        ]
      );

      $chartArrayTotalPost ["yAxis"] = array (
        "min" => 0,
        "title" => [
            "text" => 'Komentar'
         ],
        "stackLabels" => [
            "enabled" => true
        ]
      );

      $chartArrayTotalPost ["series"] [] = array (
        "name" => 'Facebook Resmi',
        "data" => $hitungPostFBResmi,
      );
      $chartArrayTotalPost ["series"] [] = array (
        "name" => 'Twitter Resmi',
        "data" => $hitungPostTWResmi,
      );
      $chartArrayTotalPost ["series"] [] = array (
        "name" => 'Youtube Resmi',
        "data" => $hitungPostYTResmi,
      );


      $chartArrayPostType ["chart"] = array (
      	"type" => "pie",
      	"plotBackgroundColor" => null,
      	"plotBorderWidth" => null,
      	"plotShadow" => false,
      );
      $chartArrayPostType ["title"] = array (
      	"text" => "Jenis Pos Facebook"
      );
      $chartArrayPostType ["credits"] = array (
      	"enabled" => true
      );

      $chartArrayPostType ["tooltip"] = array (
      	"pointFormat" => "{series.name}:<b>{point.percentage:.1f}%</b>"
      );

      $chartArrayPostType ["plotOptions"] = array (
      "pie" => [
      	"allowPointSelect" => true,
      	  "cursor" => 'pointer',
      	"dataLabels" => [
      		"enabled" => true,
      		"format" => '<b>{point.name}</b>:{point.percentage:.1f} %',
      		"style" => [
      			"color" => "black"
      		]
      	]
      ]
      );


      $arrayFB = [];
      for($i=0; $i< count($namaPostTypeFacebook); $i ++) {
        $arrayFB[$i] = [$namaPostTypeFacebook[$i], $jumlahTypePostFacebookResmi[$i]];
      }

      $chartArrayPostType ["series"] [] = array (
      	"name" => 'post type',
      	"colorByPoint" => true,
      	"data" => $arrayFB,
      );

      $chartArrayTweetType ["chart"] = array (
      	"type" => "pie",
      	"plotBackgroundColor" => null,
      	"plotBorderWidth" => null,
      	"plotShadow" => false,
      );
      $chartArrayTweetType ["title"] = array (
      	"text" => "Jenis Tweet Twitter"
      );
      $chartArrayTweetType ["credits"] = array (
      	"enabled" => true
      );

      $chartArrayTweetType ["tooltip"] = array (
      	"pointFormat" => "{series.name}:<b>{point.percentage:.1f}%</b>"
      );

      $chartArrayTweetType ["plotOptions"] = array (
      	"pie" => [
      		"allowPointSelect" => true,
      		"cursor" => 'pointer',
      		"dataLabels" => [
      			"enabled" => true,
      			"format" => '<b>{point.name}</b>:{point.percentage:.1f} %',
      			"style" => [
      			"color" => "black"
      		]
      	]
      ]
      );


      $arrayTW = [];
      for($i=0; $i< count($namaPostTypeTwitter); $i ++) {
      	$arrayTW[$i] = [$namaPostTypeTwitter[$i], $jumlahTypeTweetTwitterResmi[$i]];
      }

      $chartArrayTweetType ["series"] [] = array (
      	"name" => 'post type',
      	"colorByPoint" => true,
      	"data" => $arrayTW,
      );



      return view('klasifikasiPostPemda',['pemda' => $pemda])->withChartArrayTotalKlasifikasiPost($chartArrayTotalKlasifikasiPost)->withChartArrayTotalPost($chartArrayTotalPost)->withChartArrayPostType($chartArrayPostType)->withChartArrayTweetType($chartArrayTweetType);
    }
}

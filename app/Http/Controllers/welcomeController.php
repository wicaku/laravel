<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;
use App\Model\facebookCommentsModel;
use App\Model\twitter_replyModel;
use App\Model\youtubeCommentsModel;

class welcomeController extends Controller
{
    public function index() {
      date_default_timezone_set("Asia/Jakarta");
      $pemda = listPemdaModel::all()->count();
      $facebook_resmi = listPemdaModel::where('facebook_resmi', '!=', "")->count();
      $twitter_resmi = listPemdaModel::where('twitter_resmi', '!=', "")->count();
      $youtube_resmi = listPemdaModel::where('youtube_resmi', '!=', "")->count();
      $komentar = facebookCommentsModel::where('comment_createdDate', date("Y-m-d"))->count() + twitter_replyModel::where('tweet_createdDate', date("Y-m-d"))->count() + youtubeCommentsModel::where('comment_createdDate', date("Y-m-d"))->count();
      $semuaKomentar = facebookCommentsModel::all()->count() + twitter_replyModel::all()->count() + youtubeCommentsModel::all()->count();
      $komentarCategory = facebookCommentsModel::where('category', '!=', "uncategorized")->where('category', '!=', "duplicate")->count() + twitter_replyModel::where('category', '!=', "uncategorized")->where('category', '!=', "duplicate")->count() + youtubeCommentsModel::where('category', '!=', "uncategorized")->where('category', '!=', "duplicate")->count();
      $komentarTidakCategory = facebookCommentsModel::where('category', "uncategorized")->count() + twitter_replyModel::where('category',"uncategorized")->count() + youtubeCommentsModel::where('category', "uncategorized")->count();
      $komentarDuplicate = facebookCommentsModel::where('category', "duplicate")->count() + twitter_replyModel::where('category',"duplicate")->count() + youtubeCommentsModel::where('category', "duplicate")->count();
      $rataKomentar = round($semuaKomentar / $pemda,2);

      for($i = 9; $i >= 0; $i --) {
        $tanggal[] = date('Y-m-d', strtotime('-'.$i.' days',  strtotime(date("Y-m-d"))));
      }

      //komen
      foreach($tanggal as $tgl) {
        $hitungKomenFB[] = facebookCommentsModel::where('comment_createdDate', $tgl)->count();
        $hitungKomenTW[] = twitter_replyModel::where('tweet_createdDate', $tgl)->count();
        $hitungKomenYT[] = youtubeCommentsModel::where('comment_createdDate', $tgl)->count();
      }

      $chartArray ["chart"] = array (
          "type" => "line"
      );
      $chartArray ["title"] = array (
          "text" => "Jumlah Komentar yang Masuk 10 hari terakhir"
      );
      $chartArray ["credits"] = array (
          "enabled" => true
      );

      for($i = 0; $i < count ( $tanggal ); $i++) {
        $chartArray ["xAxis"][] = array (
               "categories" => $tanggal
        );
      }

      $chartArray ["tooltip"] = array (
          "valueSuffix" => " Komentar"
      );

      $chartArray ["plotOptions"] = array (
          "line" => [
              "dataLabels" => [
                'enabled' => true,
                'color' => 'black'
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
            "name" => 'Facebook',
			      "data" => $hitungKomenFB,
	   );
     $chartArray ["series"] [] = array (
            "name" => 'Twitter',
			      "data" => $hitungKomenTW,
	   );
     $chartArray ["series"] [] = array (
            "name" => 'Youtube',
			      "data" => $hitungKomenYT
	   );
    return view('welcome', ['pemda' => $pemda, 'facebook_resmi' => $facebook_resmi, 'twitter_resmi' => $twitter_resmi, 'youtube_resmi' => $youtube_resmi, 'komentar' => $komentar, 'komentarCategory' => $komentarCategory, 'komentarTidakCategory' => $komentarTidakCategory, 'komentarDuplicate' => $komentarDuplicate, 'rataKomentar' => $rataKomentar])->withChartArray($chartArray)->withChartArray($chartArray);
    }
}

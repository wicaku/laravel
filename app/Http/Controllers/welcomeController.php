<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;
use App\Model\facebookCommentsModel;
use App\Model\twitter_replyModel;
use App\Model\youtubeCommentsModel;
use App\Model\facebookPostsModel;
use App\Model\twitterPostsModel;
use App\Model\youtubePostsModel;

use App\Model\facebookAccountsResultModel;
use App\Model\twitterAccountsResultModel;
use App\Model\youtubeAccountsResultModel;

class welcomeController extends Controller
{
    public function index() {
      date_default_timezone_set("Asia/Jakarta");
      $pemda = listPemdaModel::all()->count();
      $facebook_resmi = listPemdaModel::where('facebook_resmi', '!=', "")->count();
      $twitter_resmi = listPemdaModel::where('twitter_resmi', '!=', "")->count();
      $youtube_resmi = listPemdaModel::where('youtube_resmi', '!=', "")->count();
      $komentar = facebookCommentsModel::where('comment_createdDate', date("Y-m-d"))->count() + twitter_replyModel::where('tweet_createdDate', date("Y-m-d"))->count() + youtubeCommentsModel::where('comment_createdDate', date("Y-m-d"))->count();
      $post = facebookPostsModel::where('post_createdDate', date("Y-m-d"))->count() + twitterPostsModel::where('tweet_createdDate', date("Y-m-d"))->count() + youtubePostsModel::where('video_createdDate', date("Y-m-d"))->count();
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
        $hitungPostFB[] = facebookPostsModel::where('post_createdDate', $tgl)->count();
        $hitungPostTW[] = twitterPostsModel::where('tweet_createdDate', $tgl)->count();
        $hitungPostYT[] = youtubePostsModel::where('video_createdDate', $tgl)->count();
      }

      //chart array komentar
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

      //chart array post
      $chartArrayPost ["chart"] = array (
          "type" => "line"
      );
      $chartArrayPost ["title"] = array (
        "text" => "Jumlah Post yang Masuk 10 hari terakhir"
      );
      $chartArrayPost ["credits"] = array (
        "enabled" => true
      );

      for($i = 0; $i < count ( $tanggal ); $i++) {
      $chartArrayPost ["xAxis"][] = array (
      	   "categories" => $tanggal
      );
      }

      $chartArrayPost ["tooltip"] = array (
        "valueSuffix" => " Post"
      );

      $chartArrayPost ["plotOptions"] = array (
        "line" => [
      	  "dataLabels" => [
      		'enabled' => true,
      		'color' => 'black'
      		]
      	]
      );

      $chartArrayPost ["yAxis"] = array (
        "min" => 0,
        "title" => [
      	  "text" => 'Komentar'
        ],
        "stackLabels" => [
      	  "enabled" => true
        ]
      );

      $chartArrayPost ["series"] [] = array (
      	"name" => 'Facebook',
      		  "data" => $hitungPostFB,
      );
      $chartArrayPost ["series"] [] = array (
      	"name" => 'Twitter',
      		  "data" => $hitungPostTW,
      );
      $chartArrayPost ["series"] [] = array (
      	"name" => 'Youtube',
      		  "data" => $hitungPostYT
      );

      $listPemda = listPemdaModel::all();
      foreach ($listPemda as $lp) {
        $namaPemda[] = $lp['name'];

        $facebookResmiLower = strtolower($lp['facebook_resmi']);
        $engagementScoreFB = facebookAccountsResultModel::orderBy('result_createdDate', 'desc')->where('page_id', $facebookResmiLower)->first();
        $lp['engagementScoreFB'] = round($engagementScoreFB['result.scores.engagement_index_score'],2);

        $twitterResmiLower = strtolower($lp['twitter_resmi']);
        $engagementScoreTW = twitterAccountsResultModel::orderBy('result_createdDate', 'desc')->where('account_id', $twitterResmiLower)->first();
        $lp['engagementScoreTW'] = round($engagementScoreTW['result.scores.engagement_index_score'],2);

        $youtubeResmiLower = strtolower($lp['youtube_resmi']);
        $engagementScoreYT = youtubeAccountsResultModel::orderBy('result_createdDate', 'desc')->where('channel_id', $youtubeResmiLower)->first();
        $lp['engagementScoreYT'] = round($engagementScoreYT['result.scores.engagement_index_score'],2);

        $lp['total'] = $lp['engagementScoreFB'] + $lp['engagementScoreTW'] + $lp['engagementScoreYT'];

        $lp['emoji'] = round($engagementScoreFB['result.scores.reaction_score.total'],5);

        $lp['rating'] = round($engagementScoreYT['result.scores.rating_score'],5);

      }

      $top10pemdaEngagement = $listPemda->sortByDesc('total')->take(10);
      $top10pemdaEmoji = $listPemda->sortByDesc('emoji')->take(10);
      $top10pemdaRating = $listPemda->sortByDesc('rating')->take(30);


      foreach ($top10pemdaEngagement as $tp) {
        $namaPemda[] = $tp['name'];
        $engagementScoreFB[] = $tp['engagementScoreFB'];
        $engagementScoreTW[] = $tp['engagementScoreTW'];
        $engagementScoreYT[] = $tp['engagementScoreYT'];
      }

      foreach ($top10pemdaEmoji as $te) {
        $namaPemdaEmoji[] = $te['name'];
        $emojiScore[] = $te['emoji'];
      }

      foreach ($top10pemdaRating as $tr) {
        $namaPemdaRating[] = $tr['name'];
        $ratingScore[] = $tr['rating'];
      }

      $chartArrayEngagement ["chart"] = array (
          "type" => "column"
      );
      $chartArrayEngagement ["title"] = array (
        "text" => "Top 10 Engagement Score Pemda"
      );
      $chartArrayEngagement ["credits"] = array (
        "enabled" => true
      );

      for($i = 0; $i < count ( $namaPemda ); $i++) {
      $chartArrayEngagement ["xAxis"][] = array (
      	   "categories" => $namaPemda
      );
      }

      $chartArrayEngagement ["tooltip"] = array (
        "valueSuffix" => " Engagement Score"
      );

      $chartArrayEngagement ["plotOptions"] = array (
        "column" => [
      	  "stacking" => 'normal',
      	  "dataLabels" => [
      		'enabled' => true,
      		'color' => 'white'
      		]
      	]

      );

      $chartArrayEngagement ["yAxis"] = array (
        "min" => 0,
        "title" => [
      	  "text" => 'Score'
        ],
        "stackLabels" => [
      	  "enabled" => true
        ]
      );

      $chartArrayEngagement ["series"] [] = array (
      	"name" => 'Facebook',
      	"data" => $engagementScoreFB,

      );
      $chartArrayEngagement ["series"] [] = array (
      	"name" => 'Twitter',
      	"data" => $engagementScoreTW,
      );
      $chartArrayEngagement ["series"] [] = array (
      	"name" => 'Youtube',
      	"data" => $engagementScoreYT,
      );

      $chartArrayEmoji ["chart"] = array (
                "type" => "column"
      );
      $chartArrayEmoji ["title"] = array (
        "text" => "Top 10 Nilai Facebook Reactions"
      );
      $chartArrayEmoji ["credits"] = array (
        "enabled" => true
      );

      for($i = 0; $i < count ( $namaPemdaEmoji ); $i++) {
      $chartArrayEmoji ["xAxis"][] = array (
      	   "categories" => $namaPemdaEmoji
      );
      }

      $chartArrayEmoji ["tooltip"] = array (
        "valueSuffix" => " Reaction Score"
      );

      $chartArrayEmoji ["plotOptions"] = array (
        "column" => [
      	  "stacking" => 'normal',
      	  "dataLabels" => [
        		'enabled' => false,
        		'color' => 'white'
      		]
      	]

      );

      $chartArrayEmoji ["yAxis"] = array (
        "min" => 0,
        "title" => [
      	  "text" => 'Score'
        ],
        "stackLabels" => [
      	  "enabled" => true
        ]
      );

      $chartArrayEmoji ["series"] [] = array (
      	"name" => 'Facebook',
      	"data" => $emojiScore,
      );

      $chartArrayRating ["chart"] = array (
          "type" => "column"
      );
      $chartArrayRating ["title"] = array (
        "text" => "Top 30 Rating Youtube"
      );
      $chartArrayRating ["credits"] = array (
        "enabled" => true
      );

      for($i = 0; $i < count ( $namaPemdaRating ); $i++) {
      $chartArrayRating ["xAxis"][] = array (
      	   "categories" => $namaPemdaRating
      );
      }

      $chartArrayRating ["tooltip"] = array (
        "valueSuffix" => " Rating Score"
      );

      $chartArrayRating ["plotOptions"] = array (
        "column" => [
      	  "stacking" => 'normal',
      	]

      );

      $chartArrayRating ["yAxis"] = array (
        "min" => 0,
        "title" => [
      	  "text" => 'Rating Score'
        ],
        "stackLabels" => [
      	  "enabled" => true
        ]
      );

      $chartArrayRating ["series"] [] = array (
      	"name" => 'Youtube',
      	"data" => $ratingScore,
      );

    return view('welcome', ['pemda' => $pemda, 'facebook_resmi' => $facebook_resmi, 'twitter_resmi' => $twitter_resmi, 'youtube_resmi' => $youtube_resmi, 'komentar' => $komentar, 'komentarCategory' => $komentarCategory, 'komentarTidakCategory' => $komentarTidakCategory, 'komentarDuplicate' => $komentarDuplicate, 'rataKomentar' => $rataKomentar, 'post' => $post])->withChartArray($chartArray)->withChartArrayPost($chartArrayPost)->withChartArrayEngagement($chartArrayEngagement)->withChartArrayEmoji($chartArrayEmoji)->withChartArrayRating($chartArrayRating);
    }
}

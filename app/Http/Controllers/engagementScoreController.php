<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;
use App\Model\dinasModel;
use App\Model\twitter_replyModel;
use App\Model\facebookCommentsModel;
use App\Model\youtubeCommentsModel;

use App\Model\facebookAccountsResultModel;
use App\Model\twitterAccountsResultModel;
use App\Model\youtubeAccountsResultModel;

class engagementScoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
      return view('engagementScore', ['engagement' => $listPemda]);
    }

    public function engagementPemda($id) {
      $listPemda = listPemdaModel::where('_id', (int)$id)->get();
      foreach ($listPemda as $lp) {
        $namaPemda[] = $lp['name'];
        $facebookResmiLower = strtolower($lp['facebook_resmi']);
        $postFB = facebookAccountsResultModel::orderBy('result_createdDate', 'desc')->where('page_id', $facebookResmiLower)->first();
        $lp['jumlahPostFB'] = $postFB['result.statistics.postCount'];
        $lp['jumlahLikeFB'] = $postFB['result.statistics.reactions.like'];
        $lp['jumlahKomentarFB'] = $postFB['result.statistics.commentCount'];
        $lp['jumlahReshareFB'] = $postFB['result.statistics.reshareCount'];
        $lp['persentasePosLikeFB'] = round($postFB['result.scores.popularity_likeScore.popularity_likeScore_1'],4) * 100;
        $lp['persentasePosKomentarFB'] = round($postFB['result.scores.commitment_commentScore.commitment_commentScore_1'],4) * 100;
        $lp['persentasePosShareFB'] = round($postFB['result.scores.virality_shareScore.virality_shareScore_1'],4) * 100;
        $lp['engagementFB'] = round($postFB['result.scores.engagement_index_score'],2);

        $twitterResmiLower = strtolower($lp['twitter_resmi']);
        $postTW = twitterAccountsResultModel::orderBy('result_createdDate', 'desc')->where('account_id', $twitterResmiLower)->first();
        $lp['jumlahTweetTW'] = $postTW['result.statistics.tweetCount'];
        $lp['jumlahLikeTW'] = $postTW['result.statistics.favoriteCount'];
        $lp['jumlahKomentarTW'] = $postTW['result.statistics.replyCount'];
        $lp['jumlahRetweetTW'] = $postTW['result.statistics.retweetCount'];
        $lp['persentaseTweetLikeTW'] = round($postTW['result.scores.popularity_favoriteScore.popularity_favoriteScore_1'],4) * 100;
        $lp['persentaseTweetKomentarTW'] = round($postTW['result.scores.commitment_replyScore.commitment_replyScore_1'],4) * 100;
        $lp['persentaseTweetRetweetTW'] = round($postTW['result.scores.virality_retweetScore.virality_retweetScore_1'],4) * 100;
        $lp['engagementTW'] = round($postTW['result.scores.engagement_index_score'],2);

        $youtubeResmiLower = strtolower($lp['youtube_resmi']);
        $postYT = youtubeAccountsResultModel::orderBy('result_createdDate', 'desc')->where('channel_id', $youtubeResmiLower)->first();
        $lp['jumlahVideoYT'] = $postYT['result.statistics.videoCount'];
        $lp['jumlahLikeYT'] = $postYT['result.statistics.likeCount'];
        $lp['jumlahKomentarYT'] = $postYT['result.statistics.commentCount'];
        $lp['persentaseVideoLikeYT'] = round($postYT['result.scores.popularity_likeScore.popularity_likeScore_1'],4) * 100;
        $lp['persentaseVideoKomentarYT'] = round($postYT['result.scores.commitment_commentScore.commitment_commentScore_1'],4) * 100;
        $lp['engagementYT'] = round($postYT['result.scores.engagement_index_score'],2);
      }

      $sortFB = facebookAccountsResultModel::orderBy('result_createdDate')->where('page_id', strtolower($listPemda[0]['facebook_resmi']))->get();

      $tanggalFacebook[] = [];
      $engagementScoreFacebook[] = [];
      foreach($sortFB as $sf) {
        $tanggalFacebook[] = $sf['result_createdDate'];
        $engagementScoreFacebook[] = $sf['result.scores.engagement_index_score'];
      }

      $chartArrayFB ["chart"] = array (
                "type" => "line"
      );
      $chartArrayFB ["title"] = array (
        "text" => "Engagement Score"
      );
      $chartArrayFB ["credits"] = array (
        "enabled" => true
      );

      for($i = 0; $i < count ( $tanggalFacebook ); $i++) {
      $chartArrayFB ["xAxis"][] = array (
      	   "categories" => $tanggalFacebook
      );
      }

      $chartArrayFB ["tooltip"] = array (
        "valueSuffix" => " Score"
      );

      $chartArrayFB ["plotOptions"] = array (
        "line" => [
      	  "dataLabels" => [
      		'enabled' => true,
      		'color' => 'black'
      		]
      	]
      );

      $chartArrayFB ["yAxis"] = array (
        "min" => 0,
        "title" => [
      	  "text" => 'Score'
        ],
        "stackLabels" => [
      	  "enabled" => true
        ]
      );

      $chartArrayFB ["series"] [] = array (
      	"name" => 'Facebook',
      		  "data" => $engagementScoreFacebook,
      );

    $sortTW = twitterAccountsResultModel::orderBy('result_createdDate')->where('account_id', strtolower($listPemda[0]['twitter_resmi']))->get();

    $tanggalTwitter[] = [];
    $engagementScoreTwitter[] = [];
    foreach($sortTW as $st) {
      $tanggalTwitter[] = $st['result_createdDate'];
      $engagementScoreTwitter[] = $st['result.scores.engagement_index_score'];
    }

    $chartArrayTW ["chart"] = array (
          "type" => "line"
    );
    $chartArrayTW ["title"] = array (
      "text" => "Engagement Score"
    );
    $chartArrayTW ["credits"] = array (
      "enabled" => true
    );

    for($i = 0; $i < count ( $tanggalTwitter ); $i++) {
    $chartArrayTW ["xAxis"][] = array (
    	   "categories" => $tanggalTwitter
    );
    }

    $chartArrayTW ["tooltip"] = array (
      "valueSuffix" => " Score"
    );

    $chartArrayTW ["plotOptions"] = array (
      "line" => [
    	  "dataLabels" => [
    		'enabled' => true,
    		'color' => 'black'
    		]
    	]
    );

    $chartArrayTW ["yAxis"] = array (
      "min" => 0,
      "title" => [
    	  "text" => 'Score'
      ],
      "stackLabels" => [
    	  "enabled" => true
      ]
    );

    $chartArrayTW ["series"] [] = array (
    	"name" => 'Twitter',
    		  "data" => $engagementScoreTwitter,
    );

    $sortYT = youtubeAccountsResultModel::orderBy('result_createdDate')->where('channel_id', strtolower($listPemda[0]['youtube_resmi']))->get();

    $tanggalYoutube[] = [];
    $engagementScoreYoutube[] = [];
    foreach($sortYT as $sy) {
      $tanggalYoutube[] = $sy['result_createdDate'];
      $engagementScoreYoutube[] = $sy['result.scores.engagement_index_score'];
    }

    $chartArrayYT ["chart"] = array (
          "type" => "line"
    );
    $chartArrayYT ["title"] = array (
      "text" => "Engagement Score"
    );
    $chartArrayYT ["credits"] = array (
      "enabled" => true
    );

    for($i = 0; $i < count ( $tanggalYoutube ); $i++) {
    $chartArrayYT ["xAxis"][] = array (
    	   "categories" => $tanggalYoutube
    );
    }

    $chartArrayYT ["tooltip"] = array (
      "valueSuffix" => " Score"
    );

    $chartArrayYT ["plotOptions"] = array (
      "line" => [
    	  "dataLabels" => [
    		'enabled' => true,
    		'color' => 'black'
    		]
    	]
    );

    $chartArrayYT ["yAxis"] = array (
      "min" => 0,
      "title" => [
    	  "text" => 'Score'
      ],
      "stackLabels" => [
    	  "enabled" => true
      ]
    );

    $chartArrayYT ["series"] [] = array (
    	"name" => 'Youtube',
    		  "data" => $engagementScoreYoutube,
    );


    return view('engagementScorePemda', ['engagement' => $listPemda])->withChartArrayFB($chartArrayFB)->withChartArrayTW($chartArrayTW)->withChartArrayYT($chartArrayYT);

    }

}

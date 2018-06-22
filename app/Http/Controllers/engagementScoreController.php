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
        $lp['engagementScoreFB'] = round($engagementScoreFB['result.scores.engagement_index_score_normalized'],2);

        $twitterResmiLower = strtolower($lp['twitter_resmi']);
        $engagementScoreTW = twitterAccountsResultModel::orderBy('result_createdDate', 'desc')->where('account_id', $twitterResmiLower)->first();
        $lp['engagementScoreTW'] = round($engagementScoreTW['result.scores.engagement_index_score_normalized'],2);

        $youtubeResmiLower = strtolower($lp['youtube_resmi']);
        $engagementScoreYT = youtubeAccountsResultModel::orderBy('result_createdDate', 'desc')->where('channel_id', $youtubeResmiLower)->first();
        $lp['engagementScoreYT'] = round($engagementScoreYT['result.scores.engagement_index_score_normalized'],2);

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
        $lp['engagementFB'] = round($postFB['result.scores.engagement_index_score_normalized'],2);
        $lp['haha'] = round($postFB['result.statistics.reactions.haha'],2);
        $lp['love'] = round($postFB['result.statistics.reactions.love'],2);
        $lp['like'] = round($postFB['result.statistics.reactions.like'],2);
        $lp['sad'] = round($postFB['result.statistics.reactions.sad'],2);
        $lp['wow'] = round($postFB['result.statistics.reactions.wow'],2);
        $lp['angry'] = round($postFB['result.statistics.reactions.angry'],2);
        $lp['totalScoreReaction'] = round($postFB['result.scores.reaction_score.total'],2);
        $lp['page_fanCount'] = $postFB['page_fanCount'];


        $twitterResmiLower = strtolower($lp['twitter_resmi']);
        $postTW = twitterAccountsResultModel::orderBy('result_createdDate', 'desc')->where('account_id', $twitterResmiLower)->first();
        $lp['jumlahTweetTW'] = $postTW['result.statistics.tweetCount'];
        $lp['jumlahLikeTW'] = $postTW['result.statistics.favoriteCount'];
        $lp['jumlahKomentarTW'] = $postTW['result.statistics.replyCount'];
        $lp['jumlahRetweetTW'] = $postTW['result.statistics.retweetCount'];
        $lp['persentaseTweetLikeTW'] = round($postTW['result.scores.popularity_favoriteScore.popularity_favoriteScore_1'],4) * 100;
        $lp['persentaseTweetKomentarTW'] = round($postTW['result.scores.commitment_replyScore.commitment_replyScore_1'],4) * 100;
        $lp['persentaseTweetRetweetTW'] = round($postTW['result.scores.virality_retweetScore.virality_retweetScore_1'],4) * 100;
        $lp['engagementTW'] = round($postTW['result.scores.engagement_index_score_normalized'],2);
        $lp['account_followerCount'] = $postTW['account_followerCount'];

        $youtubeResmiLower = strtolower($lp['youtube_resmi']);
        $postYT = youtubeAccountsResultModel::orderBy('result_createdDate', 'desc')->where('channel_id', $youtubeResmiLower)->first();
        $lp['jumlahVideoYT'] = $postYT['result.statistics.videoCount'];
        $lp['jumlahLikeYT'] = $postYT['result.statistics.likeCount'];
        $lp['jumlahKomentarYT'] = $postYT['result.statistics.commentCount'];
        $lp['persentaseVideoLikeYT'] = round($postYT['result.scores.popularity_likeScore.popularity_likeScore_1'],4) * 100;
        $lp['persentaseVideoKomentarYT'] = round($postYT['result.scores.commitment_commentScore.commitment_commentScore_1'],4) * 100;
        $lp['engagementYT'] = round($postYT['result.scores.engagement_index_score_normalized'],2);
        $lp['likeCountYT'] = $postYT['result.statistics.likeCount'];
        $lp['dislikeCountYT'] = $postYT['result.statistics.dislikeCount'];
        $lp['ratingScoreYT'] = $postYT['result.scores.rating_score'];
        $lp['channel_subscriberCount'] = $postYT['channel_subscriberCount'];
      }


      $sortFB = facebookAccountsResultModel::orderBy('result_createdDate')->where('page_id', strtolower($listPemda[0]['facebook_resmi']))->get();

      $tanggalFacebook = [];
      $engagementScoreFacebook = [];
      $postTypeScore = [];
      $fbReactionTotal = [];
      foreach($sortFB as $sf) {
        $tanggalFacebook[] = $sf['result_createdDate'];
        $engagementScoreFacebook[] = $sf['result.scores.engagement_index_score'];
        $fbAlbum = round($sf['post_type_result.album.scores.engagement_index_score'],2);
        $fbLink = round($sf['post_type_result.link.scores.engagement_index_score'],2);
        $fbNote = round($sf['post_type_result.note.scores.engagement_index_score'],2);
        $fbPhoto = round($sf['post_type_result.photo.scores.engagement_index_score'],2);
        $fbStatus = round($sf['post_type_result.status.scores.engagement_index_score'],2);
        $fbVideo = round($sf['post_type_result.video.scores.engagement_index_score'],2);

        $postTypeScore[] = [$fbAlbum, $fbLink, $fbNote, $fbPhoto, $fbStatus, $fbVideo];

        $fbReactionTotal[] = [round($sf['result.scores.reaction_score.total'],2)];
      }



      $chartArrayFB ["chart"] = array (
                "type" => "line"
      );
      $chartArrayFB ["title"] = array (
        "text" => "Engagement Score Facebook"
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
        "showInLegend" => false,
      	"name" => 'Facebook',
      		  "data" => $engagementScoreFacebook,
      );

    $sortTW = twitterAccountsResultModel::orderBy('result_createdDate')->where('account_id', strtolower($listPemda[0]['twitter_resmi']))->get();

    $tanggalTwitter = [];
    $engagementScoreTwitter = [];
    $tweetTypeScore = [];
    foreach($sortTW as $st) {
      $tanggalTwitter[] = $st['result_createdDate'];
      $engagementScoreTwitter[] = $st['result.scores.engagement_index_score'];

      $twGif = round($st['post_type_result.animated_gif.scores.engagement_index_score'],2);
      $twPhoto = round($st['post_type_result.photo.scores.engagement_index_score'],2);
      $twText = round($st['post_type_result.text.scores.engagement_index_score'],2);
      $twVideo = round($st['post_type_result.video.scores.engagement_index_score'],2);

      $tweetTypeScore[] = [$twGif, $twPhoto, $twText, $twVideo];
    }

    $chartArrayTW ["chart"] = array (
          "type" => "line"
    );
    $chartArrayTW ["title"] = array (
      "text" => "Engagement Score Twitter"
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
      "showInLegend" => false,
    	"name" => 'Twitter',
    		  "data" => $engagementScoreTwitter,
    );

    $sortYT = youtubeAccountsResultModel::orderBy('result_createdDate')->where('channel_id', strtolower($listPemda[0]['youtube_resmi']))->get();
    $tanggalYoutube = [];
    $engagementScoreYoutube = [];
    $ratingScoreYT = [];
    foreach($sortYT as $sy) {
      $tanggalYoutube[] = $sy['result_createdDate'];
      $engagementScoreYoutube[] = $sy['result.scores.engagement_index_score'];
      $ratingScoreYT[] = $sy['result.scores.rating_score'];
    }

    $chartArrayYT ["chart"] = array (
          "type" => "line"
    );
    $chartArrayYT ["title"] = array (
      "text" => "Engagement Score Youtube"
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
      "showInLegend" => false,
    	"name" => 'Youtube',
    		  "data" => $engagementScoreYoutube,
    );

    $chartArrayPostFB["chart"] = array (
          "type" => "column"
    );
    $chartArrayPostFB["title"] = array (
      "text" => "Engagement Score Post Type Facebook"
    );
    $chartArrayPostFB["credits"] = array (
      "enabled" => true
    );

    $postType = ['Album', 'Link', 'Note', 'Photo', 'Status', 'Video'];


    for($i = 0; $i < count ( $postType ); $i++) {
      $chartArrayPostFB["xAxis"][] = array (
      	   "categories" => $postType
      );
    }

    $chartArrayPostFB["tooltip"] = array (
      "valueSuffix" => " Score"
    );

    $chartArrayPostFB["plotOptions"] = array (
      "column" => [
    	  "dataLabels" => [
      		'enabled' => true,
      		'color' => 'black'
    		]
    	]
    );

    $chartArrayPostFB["yAxis"] = array (
      "min" => 0,
      "title" => [
    	  "text" => 'Score'
      ],
    );



      $chartArrayPostFB["series"] [] = array (
        "showInLegend" => false,
        "name" => 'Post Type Facebook',
        "data" => end($postTypeScore),
      );


    $chartArrayPostTW["chart"] = array (
      "type" => "column"
    );
    $chartArrayPostTW["title"] = array (
      "text" => "Engagement Score Post Type Twitter"
    );
    $chartArrayPostTW["credits"] = array (
      "enabled" => true
    );

    $tweetType = ['Animated GIF', 'Photo', 'Text', 'Video'];

    for($i = 0; $i < count ( $tweetType ); $i++) {
      $chartArrayPostTW["xAxis"][] = array (
    	   "categories" => $tweetType
      );
    }

    $chartArrayPostTW["tooltip"] = array (
      "valueSuffix" => " Score"
    );

    $chartArrayPostTW["plotOptions"] = array (
      "column" => [
    	  "dataLabels" => [
    		'enabled' => true,
    		'color' => 'black'
    		]
    	]
    );

    $chartArrayPostTW["yAxis"] = array (
      "min" => 0,
      "title" => [
    	  "text" => 'Score'
      ],
    );

    $chartArrayPostTW["series"] [] = array (
      "showInLegend" => false,
  	   "name" => 'Post Type Twitter',
  	    "data" => end($tweetTypeScore),
    );

    $chartArrayReactionPost["chart"] = array (
      "type" => "line"
    );
    $chartArrayReactionPost["title"] = array (
    	"text" => "Reaction Score Facebook"
    );
    $chartArrayReactionPost["credits"] = array (
    	"enabled" => true
    );

    for($i = 0; $i < count ( $tanggalFacebook ); $i++) {
    	$chartArrayReactionPost["xAxis"][] = array (
    		"categories" => $tanggalFacebook
    	);
    }

    $chartArrayReactionPost["tooltip"] = array (
    	"valueSuffix" => " Score"
    );

    $chartArrayReactionPost["plotOptions"] = array (
    	"line" => [
    	  "dataLabels" => [
    		'enabled' => true,
    		'color' => 'black'
    		]
    	]
    );

    $chartArrayReactionPost["yAxis"] = array (
    	"min" => 0,
    	"title" => [
    	  "text" => 'Score'
    	],
    	"stackLabels" => [
    	  "enabled" => true
    	]
    );

    $chartArrayReactionPost["series"] [] = array (
      "showInLegend" => false,
    	"name" => 'Facebook',
    	"data" => $fbReactionTotal,
    );

    $chartArrayRatingYoutube["chart"] = array (
      "type" => "line"
    );
    $chartArrayRatingYoutube["title"] = array (
    	"text" => "Rating Score Youtube"
    );
    $chartArrayRatingYoutube["credits"] = array (
    	"enabled" => true
    );

    for($i = 0; $i < count ( $tanggalYoutube ); $i++) {
    	$chartArrayRatingYoutube["xAxis"][] = array (
    		"categories" => $tanggalYoutube
    	);
    }

    $chartArrayRatingYoutube["tooltip"] = array (
    	"valueSuffix" => " Score"
    );

    $chartArrayRatingYoutube["plotOptions"] = array (
    	"line" => [
    	  "dataLabels" => [
    		'enabled' => true,
    		'color' => 'black'
    		]
    	]
    );

    $chartArrayRatingYoutube["yAxis"] = array (
    	"min" => 0,
    	"title" => [
    	  "text" => 'Score'
    	],
    	"stackLabels" => [
    	  "enabled" => true
    	]
    );

    $chartArrayRatingYoutube["series"] [] = array (
      "showInLegend" => false,
    	"name" => 'Youtube',
    	"data" => $ratingScoreYT,
    );

    return view('engagementScorePemda', ['engagement' => $listPemda])->withChartArrayFB($chartArrayFB)->withChartArrayTW($chartArrayTW)->withChartArrayYT($chartArrayYT)->withChartArrayPostFB($chartArrayPostFB)->withChartArrayPostTW($chartArrayPostTW)->withChartArrayReactionPost($chartArrayReactionPost)->withChartArrayRatingYoutube($chartArrayRatingYoutube);

    }

}

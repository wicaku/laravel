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

use App\Model\facebookPostTypeResultModel;
use App\Model\twitterPostTypeResultModel;

class welcomeController extends Controller
{
    public function index() {
      date_default_timezone_set("Asia/Jakarta");
      $pemda = listPemdaModel::all()->count();
      $facebook_resmi = listPemdaModel::where('facebook_resmi', '!=', "")->count();
      $facebook_influencer = listPemdaModel::where('facebook_influencer', '!=', "")->count();
      $twitter_resmi = listPemdaModel::where('twitter_resmi', '!=', "")->count();
      $twitter_influencer = listPemdaModel::where('twitter_influencer', '!=', "")->count();
      $youtube_resmi = listPemdaModel::where('youtube_resmi', '!=', "")->count();
      $youtube_influencer = listPemdaModel::where('youtube_influencer', '!=', "")->count();
      $komentar = facebookCommentsModel::where('comment_createdDate', date("Y-m-d"))->count() + twitter_replyModel::where('tweet_createdDate', date("Y-m-d"))->count() + youtubeCommentsModel::where('comment_createdDate', date("Y-m-d"))->count();
      $post = facebookPostsModel::where('post_createdDate', date("Y-m-d"))->count() + twitterPostsModel::where('tweet_createdDate', date("Y-m-d"))->count() + youtubePostsModel::where('video_createdDate', date("Y-m-d"))->count();
      $semuaKomentar = facebookCommentsModel::all()->count() + twitter_replyModel::all()->count() + youtubeCommentsModel::all()->count();
      $postKlasifikasi = $post - facebookPostsModel::where('post_message', '')->where('post_createdDate', date("Y-m-d"))->count() + twitterPostsModel::where('tweet_message', '')->where('tweet_createdDate', date("Y-m-d"))->count() + youtubePostsModel::where('video_title', '')->where('video_createdDate', date("Y-m-d"))->count();
      $komentarCategory = facebookCommentsModel::where('category', '!=', "uncategorized")->where('category', '!=', "duplicate")->count() + twitter_replyModel::where('category', '!=', "uncategorized")->where('category', '!=', "duplicate")->count() + youtubeCommentsModel::where('category', '!=', "uncategorized")->where('category', '!=', "duplicate")->count();
      $komentarTidakCategory = facebookCommentsModel::where('category', "uncategorized")->count() + twitter_replyModel::where('category',"uncategorized")->count() + youtubeCommentsModel::where('category', "uncategorized")->count();
      $komentarDuplicate = facebookCommentsModel::where('category', "duplicate")->count() + twitter_replyModel::where('category',"duplicate")->count() + youtubeCommentsModel::where('category', "duplicate")->count();
      $rataKomentar = round($semuaKomentar / $pemda,2);

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


      $top10pemdaEngagement = $listPemda->sortByDesc('total')->take(10);

      foreach ($top10pemdaEngagement as $tp) {
        $namaPemdaEngagement[] = $tp['name'];
        $engagementScoreFB[] = $tp['engagementScoreFB'];
        $engagementScoreTW[] = $tp['engagementScoreTW'];
        $engagementScoreYT[] = $tp['engagementScoreYT'];
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

      for($i = 0; $i < count ( $top10pemdaEngagement ); $i++) {
      $chartArrayEngagement ["xAxis"][] = array (
      	   "categories" => $namaPemdaEngagement
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






      return view('welcome', ['pemda' => $pemda, 'facebook_resmi' => $facebook_resmi, 'facebook_influencer' => $facebook_influencer,'twitter_resmi' => $twitter_resmi, 'twitter_influencer' => $twitter_influencer, 'youtube_resmi' => $youtube_resmi, 'youtube_influencer' => $youtube_influencer, 'komentar' => $komentar, 'komentarCategory' => $komentarCategory, 'komentarTidakCategory' => $komentarTidakCategory, 'komentarDuplicate' => $komentarDuplicate, 'rataKomentar' => $rataKomentar, 'post' => $post, 'postKlasifikasi' => $postKlasifikasi ,'engagement' => $top10pemdaEngagement ])->withChartArrayEngagement($chartArrayEngagement);
    }

    public function Stand_Deviation($arr)
    {
        $num_of_elements = count($arr);

        $variance = 0.0;

                // calculating mean using array_sum() method
        $average = array_sum($arr)/$num_of_elements;

        foreach($arr as $i)
        {
            // sum of squares of differences between
                        // all numbers and means.
            $variance += pow(($i - $average), 2);
        }

        return (float)sqrt($variance/$num_of_elements);
    }

    public function post() {
      for($i = 9; $i >= 0; $i --) {
        $tanggal[] = date('Y-m-d', strtotime('-'.$i.' days',  strtotime(date("Y-m-d"))));
      }

      foreach($tanggal as $tgl) {
        $hitungPostFB[] = facebookPostsModel::where('post_createdDate', $tgl)->count();
        $hitungPostTW[] = twitterPostsModel::where('tweet_createdDate', $tgl)->count();
        $hitungPostYT[] = youtubePostsModel::where('video_createdDate', $tgl)->count();
      }

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
      foreach($listPemda as $lp) {
        $namaPemda[] = $lp['name'];

        $facebookResmiLower = strtolower($lp['facebook_resmi']);
        $hitungPostPemda = facebookAccountsResultModel::where('page_id', $facebookResmiLower)->first();
        $lp['postCount'] = $hitungPostPemda['result.statistics.postCount'];

        $twitterResmiLower = strtolower($lp['twitter_resmi']);
        $hitungTweetPemda = twitterAccountsResultModel::where('account', $twitterResmiLower)->first();
        $lp['tweetCount'] = $hitungTweetPemda['result.statistics.tweetCount'];

        $youtubeResmiLower = strtolower($lp['youtube_resmi']);
        $hitungVideoPemda = youtubeAccountsResultModel::where('channel_id', $youtubeResmiLower)->first();
        $lp['videoCount'] = $hitungVideoPemda['result.statistics.videoCount'];

        $lp['totalPost'] = $lp['postCount'] + $lp['tweetCount'] + $lp['videoCount'];

      }

      $sortPemdaPost = $listPemda->sortByDesc('totalPost');

      foreach ($sortPemdaPost as $spp) {
        $namaPemdaPost[] = $spp['name'];
        $jumlahPost[] = $spp['totalPost'];
      }



      $chartArrayHitungPost ["chart"] = array (
      		"type" => "column"
      );
      $chartArrayHitungPost ["title"] = array (
      	"text" => "Jumlah Post Seluruh Pemda"
      );
      $chartArrayHitungPost ["credits"] = array (
      	"enabled" => true
      );

      for($i = 0; $i < count ( $namaPemdaPost ); $i++) {
      	$chartArrayHitungPost ["xAxis"][] = array (
      		"categories" => $namaPemdaPost
      	);
      }

      $chartArrayHitungPost ["tooltip"] = array (
      	"valueSuffix" => " Post"
      );

      $chartArrayHitungPost ["plotOptions"] = array (
      	"column" => [
      		"stacking" => 'normal',
      		"dataLabels" => [
      			'enabled' => false,
      			'color' => 'white'
      		]
      	]

      );

      $chartArrayHitungPost ["yAxis"] = array (
      	"min" => 0,
      	"title" => [
      		"text" => 'Post'
      	],
      	"stackLabels" => [
      		"enabled" => true
      	]
      );

      $chartArrayHitungPost ["series"] [] = array (
      	"showInLegend" => false,
      	"data" => $jumlahPost,
      );

      print_r($this->Stand_Deviation($jumlahPost));


        return view('post')->withChartArrayPost($chartArrayPost)->withChartArrayHitungPost($chartArrayHitungPost);
    }

    public function komentar() {
      for($i = 9; $i >= 0; $i --) {
        $tanggal[] = date('Y-m-d', strtotime('-'.$i.' days',  strtotime(date("Y-m-d"))));
      }

      //komen
      foreach($tanggal as $tgl) {
        $hitungKomenFB[] = facebookCommentsModel::where('comment_createdDate', $tgl)->count();
        $hitungKomenTW[] = twitter_replyModel::where('tweet_createdDate', $tgl)->count();
        $hitungKomenYT[] = youtubeCommentsModel::where('comment_createdDate', $tgl)->count();
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

     //jumlah komentar seluruh pemda
     $listPemda = listPemdaModel::all();
     foreach($listPemda as $lp) {
       $namaPemda[] = $lp['name'];

       $facebookResmiLower = strtolower($lp['facebook_resmi']);
       $hitungPostPemda = facebookAccountsResultModel::where('page_id', $facebookResmiLower)->first();
       $lp['commentCountFBResmi'] = $hitungPostPemda['result.statistics.commentCount'];

       $facebookInfluencerLower = strtolower($lp['facebook_influencer']);
       $hitungPostPemda = facebookAccountsResultModel::where('page_id', $facebookInfluencerLower)->first();
       $lp['commentCountFBInfluencer'] = $hitungPostPemda['result.statistics.commentCount'];

       $twitterResmiLower = strtolower($lp['twitter_resmi']);
       $hitungTweetPemda = twitterAccountsResultModel::where('account', $twitterResmiLower)->first();
       $lp['replyCountResmi'] = $hitungTweetPemda['result.statistics.replyCount'];

       $twitterInfluencerLower = strtolower($lp['twitter_influencer']);
       $hitungTweetPemda = twitterAccountsResultModel::where('account', $twitterInfluencerLower)->first();
       $lp['replyCountInfluencer'] = $hitungTweetPemda['result.statistics.replyCount'];

       $youtubeResmiLower = strtolower($lp['youtube_resmi']);
       $hitungVideoPemda = youtubeAccountsResultModel::where('channel_id', $youtubeResmiLower)->first();
       $lp['commentCountYTResmi'] = $hitungVideoPemda['result.statistics.commentCount'];

       $youtubeInfluencerLower = strtolower($lp['youtube_influencer']);
       $hitungVideoPemda = youtubeAccountsResultModel::where('channel_id', $youtubeInfluencerLower)->first();
       $lp['commentCountYTInfluencer'] = $hitungVideoPemda['result.statistics.commentCount'];

       $lp['totalComment'] = $lp['commentCountFBResmi'] + $lp['replyCountResmi'] + $lp['commentCountYTResmi'] + $lp['commentCountFBInfluencer'] + $lp['replyCountInfluencer'] + $lp['commentCountYTInfluencer'] ;

     }

     $sortPemdaComment = $listPemda->sortByDesc('totalComment');

     foreach ($sortPemdaComment as $spc) {
       $namaPemdaComment[] = $spc['name'];
       $jumlahComment[] = $spc['totalComment'];
     }

      $chartArrayKomentar ["chart"] = array (
		     "type" => "column"
      );
      $chartArrayKomentar ["title"] = array (
      	"text" => "Jumlah Komentar Seluruh Pemda"
      );
      $chartArrayKomentar ["credits"] = array (
      	"enabled" => true
      );

      for($i = 0; $i < count ( $namaPemdaComment ); $i++) {
      	$chartArrayKomentar ["xAxis"][] = array (
      		"categories" => $namaPemdaComment
      	);
      }

      $chartArrayKomentar ["tooltip"] = array (
      	"valueSuffix" => " Komentar"
      );

      $chartArrayKomentar ["plotOptions"] = array (
      	"column" => [
      		"stacking" => 'normal',
      		"dataLabels" => [
      			'enabled' => false,
      			'color' => 'white'
      		]
      	]
      );


      $chartArrayKomentar ["yAxis"] = array (
      	"min" => 0,
      	"title" => [
      		"text" => 'Komentar'
      	],
      	"stackLabels" => [
      		"enabled" => true
      	]
      );

      $chartArrayKomentar ["series"] [] = array (
        "showInLegend" => false,
      	"data" => $jumlahComment,
      );


     return view('komentar')->withChartArray($chartArray)->withChartArrayKomentar($chartArrayKomentar);
    }

    public function facebook() {
      //top10facebook reactions
      $listPemda = listPemdaModel::all();

      foreach ($listPemda as $lp) {
        $namaPemda[] = $lp['name'];

        $facebookResmiLower = strtolower($lp['facebook_resmi']);
        $engagementScoreFB = facebookAccountsResultModel::orderBy('result_createdDate', 'desc')->where('page_id', $facebookResmiLower)->first();
        $lp['engagementScoreFB'] = round($engagementScoreFB['result.scores.engagement_index_score_normalized'],2);

        $lp['emoji'] = round($engagementScoreFB['result.scores.reaction_score.total'],5);

      }

      $top10pemdaEmoji = $listPemda->sortByDesc('emoji')->take(10);

      foreach ($top10pemdaEmoji as $te) {
        $namaPemdaEmoji[] = $te['name'];
        $emojiScore[] = $te['emoji'];
      }

      //grafik
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


      //jenis pos facebook
      $facebookPostTypeResult = facebookPostTypeResultModel::all();
      foreach ($facebookPostTypeResult as $fptr) {
        $namaPostTypeFacebook[] = $fptr['post_type'];
        $engagementScorePostTypeFacebook[] = $fptr['result.statistics.postCount'];
      }

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
          $arrayFB[$i] = [$namaPostTypeFacebook[$i], $engagementScorePostTypeFacebook[$i]];
      }

      $chartArrayPostType ["series"] [] = array (
      	"name" => 'post type',
      	"colorByPoint" => true,
        "data" => $arrayFB,
      );

      return view('facebook')->withChartArrayEmoji($chartArrayEmoji)->withChartArrayPostType($chartArrayPostType);
    }

    public function twitter() {
      $twitterPostTypeResult = twitterPostTypeResultModel::all();
      foreach ($twitterPostTypeResult as $tptr) {
        $namaPostTypeTwitter[] = $tptr['tweet_type'];
        $engagementScorePostTypeTwitter[] = $tptr['result.statistics.tweetCount'];
      }

      $arrayTW = [];
      for($i=0; $i< count($namaPostTypeTwitter); $i ++) {
        $arrayTW[$i] = [$namaPostTypeTwitter[$i], $engagementScorePostTypeTwitter[$i]];
      }

      $chartArrayTwitterType ["chart"] = array (
      	"type" => "pie",
      	"plotBackgroundColor" => null,
      	"plotBorderWidth" => null,
      	"plotShadow" => false,
      );
      $chartArrayTwitterType ["title"] = array (
      	"text" => "Jenis Pos Twitter"
      );
      $chartArrayTwitterType ["credits"] = array (
      	"enabled" => true
      );

      $chartArrayTwitterType ["tooltip"] = array (
      	"pointFormat" => "{series.name}:<b>{point.percentage:.1f}%</b>"
      );

      $chartArrayTwitterType ["plotOptions"] = array (
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

      $chartArrayTwitterType ["series"] [] = array (
      	"name" => 'post type',
      	"colorByPoint" => true,
      	"data" => $arrayTW,
      );
      return view('twitter')->withChartArrayTwitterType($chartArrayTwitterType);
    }

    public function youtube() {
      $listPemda = listPemdaModel::all();
      foreach ($listPemda as $lp) {
        $namaPemda[] = $lp['name'];

        $youtubeResmiLower = strtolower($lp['youtube_resmi']);
        $engagementScoreYT = youtubeAccountsResultModel::orderBy('result_createdDate', 'desc')->where('channel_id', $youtubeResmiLower)->first();
        $lp['engagementScoreYT'] = round($engagementScoreYT['result.scores.engagement_index_score_normalized'],2);

        $lp['rating'] = round($engagementScoreYT['result.scores.rating_score'],5);

      }

      $top10pemdaRating = $listPemda->sortByDesc('rating')->take(30);
      foreach ($top10pemdaRating as $tr) {
        $namaPemdaRating[] = $tr['name'];
        $ratingScore[] = $tr['rating'];
      }

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
        "color" => '#90ed7d'
      );
      return view('youtube')->withChartArrayRating($chartArrayRating);
    }

}

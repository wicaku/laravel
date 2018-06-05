<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\listPemdaModel;
use App\Model\dinasModel;
use App\Model\twitter_replyModel;
use App\Model\facebookCommentsModel;
use App\Model\youtubeCommentsModel;

use App\Model\twitterAccountsResultModel;

class twitterAccountsResultController extends Controller
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
      $twitterAccounts = twitterAccountsResultModel::where('account_id', $pemda->twitter_resmi)->get();
      $tanggal = twitterAccountsResultModel::orderBy('result_createdDate','asc')->where('account_id', $pemda->twitter_resmi)->groupBy('result_createdDate')->get();

      foreach($tanggal as $tgl) {
        $date[] = $tgl['result_createdDate'];
      }

      foreach($date as $dt) {
        $engagementScore[] = $twitterAccounts->where('result_createdDate', $dt)->first();
      }

      foreach($engagementScore as $es) {
        $egScore[] = round($es['result.scores.engagement_index_score'],3);
      }

      $chartArray ["chart"] = array (
          "type" => "line"
      );
      $chartArray ["title"] = array (
          "text" => "Engagement Score"
      );
      $chartArray ["credits"] = array (
          "enabled" => true
      );

      for($i = 0; $i < count ( $date ); $i++) {
        $chartArray ["xAxis"][] = array (
               "categories" => $date
        );
      }

      $chartArray ["tooltip"] = array (
          "valueSuffix" => " Komentar"
      );

      $chartArray ["plotOptions"] = array (
          "column" => [
              "stacking" => 'normal',

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
			      "data" => $engagementScore,
	   );
     $chartArray ["series"] [] = array (
            "name" => 'Twitter Resmi',
			      "data" => $egScore,
	   );
     $chartArray ["series"] [] = array (
            "name" => 'Youtube Resmi',
			      "data" => $engagementScore,
	   );


      return view('engagementScore', ['pemda' => $pemda])->withChartArray($chartArray);
    }
}

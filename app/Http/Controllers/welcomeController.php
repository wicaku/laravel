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
      return view('welcome', ['pemda' => $pemda, 'facebook_resmi' => $facebook_resmi, 'twitter_resmi' => $twitter_resmi, 'youtube_resmi' => $youtube_resmi, 'komentar' => $komentar, 'komentarCategory' => $komentarCategory, 'komentarTidakCategory' => $komentarTidakCategory, 'komentarDuplicate' => $komentarDuplicate, 'rataKomentar' => $rataKomentar]);
    }
}

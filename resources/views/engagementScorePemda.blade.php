@extends('master')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{route('peringkat.engagement')}}"><i class="home icon"></i>Engagement Score</a><span> / {{$engagement[0]['name']}}</span></h5></div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-engagement-fb"></div>
        <table class="ui celled table responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Jumlah Post</th>
            <th>Jumlah Like</th>
            <th>Jumlah Komentar</th>
            <th>Jumlah Reshare</th>
            <th>Persentase Post dengan Like</th>
            <th>Persentase Post dengan Komentar</th>
            <th>Persentase Post dengan Reshare</th>
            <th>Jumlah Fans</th>
            <th>Engagement Score</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($engagement as $eg)
                <tr>
                  <td>{{$eg['jumlahPostFB']}}</td>
                  <td>{{$eg['jumlahLikeFB']}}</td>
                  <td>{{$eg['jumlahKomentarFB']}}</td>
                  <td>{{$eg['jumlahReshareFB']}}</td>
                  <td>{{$eg['persentasePosLikeFB']}} %</td>
                  <td>{{$eg['persentasePosKomentarFB']}} %</td>
                  <td>{{$eg['persentasePosShareFB']}} %</td>
                  <td>{{$eg['page_fanCount']}}</td>
                  <td>{{$eg['engagementFB']}}</td>
                </tr>
          @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-engagement-tw"></div>
        <table class="ui celled table responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Jumlah Tweet</th>
            <th>Jumlah Favorite</th>
            <th>Jumlah Reply</th>
            <th>Jumlah Retweet</th>
            <th>Persentase Tweet dengan Favorite</th>
            <th>Persentase Tweet dengan Reply</th>
            <th>Persentase Tweet dengan Retweet</th>
            <th>Jumlah Follower</th>
            <th>Engagement Score</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($engagement as $eg)
                <tr>
                  <td>{{$eg['jumlahTweetTW']}}</td>
                  <td>{{$eg['jumlahLikeTW']}}</td>
                  <td>{{$eg['jumlahKomentarTW']}}</td>
                  <td>{{$eg['jumlahRetweetTW']}}</td>
                  <td>{{$eg['persentaseTweetLikeTW']}} %</td>
                  <td>{{$eg['persentaseTweetKomentarTW']}} %</td>
                  <td>{{$eg['persentaseTweetRetweetTW']}} %</td>
                  <td>{{$eg['account_followerCount']}}</td>
                  <td>{{$eg['engagementTW']}}</td>
                </tr>
          @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-engagement-yt"></div>
        <table class="ui celled table responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Jumlah Video</th>
            <th>Jumlah Like</th>
            <th>Jumlah Komentar</th>
            <th>Persentase Video dengan Like</th>
            <th>Persentase Video dengan Komentar</th>
            <th>Jumlah Subscriber</th>
            <th>Jumlah Viewer</th>
            <th>Engagement Score</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($engagement as $eg)
                <tr>
                  <td>{{$eg['jumlahVideoYT']}}</td>
                  <td>{{$eg['jumlahLikeYT']}}</td>
                  <td>{{$eg['jumlahKomentarYT']}}</td>
                  <td>{{$eg['persentaseVideoLikeYT']}} %</td>
                  <td>{{$eg['persentaseVideoKomentarYT']}} %</td>
                  <td>{{$eg['channel_subscriberCount']}}</td>
                  <td>{{$eg['viewCountYT']}}</td>
                  <td>{{$eg['engagementYT']}}</td>
                </tr>
          @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-post-type-fb"></div>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-post-type-tw"></div>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-post-reaction-fb"></div>
        <table class="ui celled table responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th><img src="{{URL::asset('/img/Haha-500px.gif')}}" height="50" width="50"></th>
            <th><img src="{{URL::asset('/img/Love-500px.gif')}}" height="50" width="50"></th>
            <th><img src="{{URL::asset('/img/Like-500px.gif')}}" height="50" width="50"></th>
            <th><img src="{{URL::asset('/img/Sad-500px.gif')}}" height="50" width="50"></th>
            <th><img src="{{URL::asset('/img/Wow-500px.gif')}}" height="50" width="50"></th>
            <th><img src="{{URL::asset('/img/Angry-500px.gif')}}" height="50" width="50"></th>
            <th>Facebook Reaction Score</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($engagement as $eg)
                <tr>
                  <td>{{$eg['haha']}}</td>
                  <td>{{$eg['love']}}</td>
                  <td>{{$eg['like']}}</td>
                  <td>{{$eg['sad']}}</td>
                  <td>{{$eg['wow']}}</td>
                  <td>{{$eg['angry']}}</td>
                  <td>{{$eg['totalScoreReaction']}}</td>
                </tr>
          @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-rating-score-yt"></div>
        <table class="ui celled table responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Jumlah Like</th>
            <th>Jumlah Dislike</th>
            <th>Rating Score</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($engagement as $eg)
                <tr>
                  <td>{{$eg['likeCountYT']}}</td>
                  <td>{{$eg['dislikeCountYT']}}</td>
                  <td>{{$eg['ratingScoreYT']}}</td>
                </tr>
          @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#engagement").addClass("active");
        $('#container-engagement-fb').highcharts( <?php  echo json_encode($chartArrayFB) ?>);
        $('#container-engagement-tw').highcharts( <?php  echo json_encode($chartArrayTW) ?>);
        $('#container-engagement-yt').highcharts( <?php  echo json_encode($chartArrayYT) ?>);
        $('#container-post-type-fb').highcharts( <?php  echo json_encode($chartArrayPostFB) ?>);
        $('#container-post-type-tw').highcharts( <?php  echo json_encode($chartArrayPostTW) ?>);
        $('#container-post-reaction-fb').highcharts( <?php  echo json_encode($chartArrayReactionPost) ?>);
        $('#container-rating-score-yt').highcharts( <?php  echo json_encode($chartArrayRatingYoutube) ?>);
    });

</script>
@endsection

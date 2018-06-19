@extends('master')
@section('title')
HOME
@endsection
@section('body')
<style>
  .daily-stats {
    font-size: 1.071rem;
    font-weight: bold;
  }
</style>
<div class="ui container">
  <div class="ui cards grid">
    <div class="card five wide column">
      <div class="content">
        <div class="header">
          Daily Stats
        </div>
        <div class="description">
          <p class="daily-stats">Tanggal Hari Ini<span style="float:right">{{date("Y-m-d")}}</span></p>
        </div>
      </div>

      <div class="extra content">
        <p class="daily-stats">Total Pemerintah Daerah<span style="float:right">{{$pemda}}</span></p>
        <p class="daily-stats">Total Facebook Resmi / Influencer<span style="float:right">{{$facebook_resmi}} / {{$facebook_influencer}}</span></p>
        <p class="daily-stats">Total Twitter Resmi / Influencer<span style="float:right">{{$twitter_resmi}} / {{$twitter_influencer}}</span></p>
        <p class="daily-stats">Total Youtube Resmi / Influencer<span style="float:right">{{$youtube_resmi}} / {{$youtube_influencer}}</span></p>
        <p class="daily-stats">Total Post Masuk<span style="float:right">{{$post}}</span></p>
        <p class="daily-stats">Total Komentar Masuk<span style="float:right">{{$komentar}}</span></p>
        <p class="daily-stats">Total Post Terklasifikasi<span style="float:right">{{$postKlasifikasi}}</span></p>
        <p class="daily-stats">Total Komentar Terklasifikasi<span style="float:right">{{$komentar}}</span></p>
        <p class="daily-stats">Total Komentar Terkategorisasi<span style="float:right">{{$komentarCategory}}</span></p>
        <p class="daily-stats">Total Komentar Tidak Terkategori<span style="float:right">{{$komentarTidakCategory}}</span></p>
        <p class="daily-stats">Total Komentar Terduplikasi<span style="float:right">{{$komentarDuplicate}}</span></p>
        <p class="daily-stats">Rata-Rata Komentar per Pemda<span style="float:right">{{$rataKomentar}}%</span></p>

      </div>
    </div>

    <div class="card ten wide column">
      <div id="container-engagement"></div>
    </div>

  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <table id="engagement" class="ui celled table responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Nama Dinas</th>
            <th>Facebook Score</th>
            <th>Twitter Score</th>
            <th>Youtube Score</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($engagement as $eg)
                <tr>
                  <td>{{$eg['name']}}</td>
                  <td>{{$eg['engagementScoreFB']}}</td>
                  <td>{{$eg['engagementScoreTW']}}</td>
                  <td>{{$eg['engagementScoreYT']}}</td>
                  <td><a href="{{route('peringkat.engagement.pemda', ['id' => $eg['_id']])}}">Detail</a></td>
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
        <div class="five ui buttons">
          <a href="{{ route('welcome.post') }}" class='ui medium icon blue button'>Post</a>
          <a href="{{ route('welcome.komentar') }}" class='ui medium icon orange button'>Komentar</a>
          <a href="{{ route('welcome.facebook') }}" class='ui medium facebook button'><i class="facebook icon"></i>Facebook</a>
          <a href="{{ route('welcome.twitter') }}" class='ui medium twitter button'><i class="twitter icon"></i>Twitter</a>
          <a href="{{ route('welcome.youtube') }}" class='ui medium youtube button'><i class="youtube icon"></i>Youtube</a>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#home").addClass("active");
        $('#container-engagement').highcharts( <?php  echo json_encode($chartArrayEngagement) ?>);


    });
</script>
@endsection

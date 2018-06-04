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
        <p class="daily-stats">Total Facebook Resmi<span style="float:right">{{$facebook_resmi}}</span></p>
        <p class="daily-stats">Total Twitter Resmi<span style="float:right">{{$twitter_resmi}}</span></p>
        <p class="daily-stats">Total Youtube Resmi<span style="float:right">{{$youtube_resmi}}</span></p>
        <p class="daily-stats">Total Post Masuk<span style="float:right">belom</span></p>
        <p class="daily-stats">Total Komentar Masuk<span style="float:right">{{$komentar}}</span></p>
        <p class="daily-stats">Total Post Terklasifikasi<span style="float:right">belom</span></p>
        <p class="daily-stats">Total Komentar Terklasifikasi<span style="float:right">{{$komentar}}</span></p>
        <p class="daily-stats">Total Komentar Terkategorisasi<span style="float:right">{{$komentarCategory}}</span></p>
        <p class="daily-stats">Total Komentar Tidak Terkategori<span style="float:right">{{$komentarTidakCategory}}</span></p>
        <p class="daily-stats">Total Komentar Terduplikasi<span style="float:right">{{$komentarDuplicate}}</span></p>
        <p class="daily-stats">Rata-Rata Komentar per Pemda<span style="float:right">{{$rataKomentar}}%</span></p>

      </div>
    </div>
    <div class="ten wide column">
      punya dito
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#home").addClass("active");
    });
</script>
@endsection

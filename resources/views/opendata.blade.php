@extends('master')
@section('title')
HOME
@endsection
@section('body')
<style>
  .monthly-stats {
    font-size: 1.071rem;
    font-weight: bold;
  }
</style>
<div class="ui container">
  <div class="ui cards grid">
    <div class="card five wide column">
      <div class="content">
        <div class="header">
          Monthly Stats
        </div>
        <div class="description">
          <p class="monthly-stats">This Month<span style="float:right">{{date("F Y")}}</span></p>
        </div>
      </div>

      <div class="extra content">
        <p class="monthly-stats">Total Pemerintah Daerah<span style="float:right">{{$pemda}}</span></p>
        <p class="monthly-stats">Total BPS Pemda<span style="float:right">{{$total_bps_pemda}}</span></p>
        <p class="monthly-stats">Total BPS Aktif<span style="float:right">{{$active_bps_pemda}}</span></p>
        <p class="monthly-stats">Total Dataset BPS<span style="float:right">{{$total_scored_bps}}</span></p>
        <p class="monthly-stats">Total Portal Open Data Pemda<span style="float:right">{{$total_ckan_pemda}}</span></p>
        <p class="monthly-stats">Total Portal Open Data Aktif<span style="float:right">{{$active_ckan_pemda}}</span></p>
        <p class="monthly-stats">Total Dataset Portal Open Data<span style="float:right">{{$total_scored_ckan}}</span></p>
        <p class="monthly-stats">Tanggal Penilaian Terakhir<span style="float:right">{{$last_result_date}}</span></p>

      </div>
    </div>
    <div class="ten wide column">
      Lorem Ipsum
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

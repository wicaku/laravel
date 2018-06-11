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
      <div class="content">
        <div id="container-top10result"></div>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-allresult"></div>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <table id="top10Result" class="ui celled table responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Nama Pemda</th>
            <th>BPS Link</th>
            <th>CKAN Link</th>
            <th>Open Data Score</th>
            <th>Detail</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($top10resultOpendata as $top10)
                <tr>
                  <td>{{$top10['nama_pemda']}}</td>
                  <td><a href="{{$top10['bps_pemda']}}">{{$top10['bps_pemda']}}</a></td>
                  <td><a href="{{$top10['ckan_pemda']}}">{{$top10['ckan_pemda']}}</a></td>
                  <td>{{$top10['totalScore']}}</td>
                  <td><a href="{{route('opendata.detail', ['id' => $top10['id_pemda']])}}">Click Here</a></td>
                </tr>
          @endforeach
        </tbody>
        </table>
    </div>
  </div>
  
  <div class="ui cards grid">
    <div class="five card wide column">
      <div class="content">
        <div id="container-provresult"></div>
      </div>
    </div>
    <div class="ten wide column">
      <div class="content">
        <div id="container-kabresult"></div>
      </div>
    </div>
    <div class="ten wide column">
      <div class="content">
        <div id="container-kotaresult"></div>
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
        $('#container-top10result').highcharts( <?php  echo json_encode($chartArrayTop10Result) ?>);
        $('#container-allresult').highcharts( <?php  echo json_encode($chartArrayAllResult) ?>);
        $('#container-provresult').highcharts( <?php  echo json_encode($chartArrayProvResult) ?>);
        $('#container-kabresult').highcharts( <?php  echo json_encode($chartArrayKabResult) ?>);
        $('#container-kotaresult').highcharts( <?php  echo json_encode($chartArrayKotaResult) ?>);
    });
</script>
@endsection

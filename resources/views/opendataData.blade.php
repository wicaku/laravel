@extends('master')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><i class="home icon"></i>Opendata</h5></div>
    </div>
  </div>

  <table id="opendataData" class="ui celled table responsive nowrap" style="width:100%">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama Pemerintah Daerah</th>
      <th>Dataset BPS</th>
      <th>Situs BPS</th>
      <th>Dataset CKAN</th>
      <th>Situs Portal Data</th>
      <th>Total Skor</th>
      <th>Detail</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($allData as $ad)
          <tr>
            <td>{{$ad['id_pemda']}}</td>
            <td>{{$ad['nama_pemda']}}</td>
            <td>{{$ad['bps_dataset']}}</td>
            <td><a href="{{$ad['bps_pemda']}}">Link BPS</a></td>
            <td>{{$ad['ckan_dataset']}}
            <td>@php
            $ckan = $ad['ckan_pemda'];
            if ($ckan != "") {
                echo "<a href= $ckan>Link Portal CKAN</a>";
            }
            else {
                echo "No Link";
            }
            @endphp</td></td></td>
            <td>{{$ad['totalScore']}}</td>
            <td><a href="{{route('opendata.detail', ['id' => $ad['id_pemda']])}}">Click Here</a></td>
          </tr>
    @endforeach
  </tbody>
  </table>
  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-subkategori"></div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#dataOpenData").addClass("active");
        $('#opendataData').DataTable();
        $('#container-subkategori').highcharts( <?php  echo json_encode($chartArraySubkategori) ?>);
    });

</script>
@endsection

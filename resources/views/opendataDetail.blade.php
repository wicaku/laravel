@extends('master')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{route('opendata.data')}}"><i class="home icon"></i>Opendata</a><span> / {{$pemda['nama_pemda']}}</span></h5></div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-resultOpendata"></div>
        <table class="ui celled table responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Periode</th>
            <th>aExist</th>
            <th>bAvailable</th>
            <th>cMachineReadable</th>
            <th>dBulk</th>
            <th>eFree</th>
            <th>fLicense</th>
            <th>gUpdated</th>
            <th>hSustainable</th>
            <th>iDiscoverable</th>
            <th>jLinked</th>
            <th>Skor Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($resultOpendata as $ro)
                <tr>
                  <td>{{$ro['tanggal']}}</td>
                  @php
                    $aResult = $ro['aResult'];
                    $bResult = $ro['bResult'];
                    $cResult = $ro['cResult'];
                    $dResult = $ro['dResult'];
                    $eResult = $ro['eResult'];
                    $fResult = $ro['fResult'];
                    $gResult = $ro['gResult'];
                    $hResult = $ro['hResult'];
                    $iResult = $ro['iResult'];
                    $jResult = $ro['jResult'];
                    if ($aResult == 1) {
                      echo "<td><img src='/img/ok.png' height='20' width='20'></td>";
                    }
                    else {
                      echo "<td><img src='/img/remove.png' height='20' width='20'></td>";
                    }
                    if ($bResult == 1) {
                      echo "<td><img src='/img/ok.png' height='20' width='20'></td>";
                    }
                    else {
                      echo "<td><img src='/img/remove.png' height='20' width='20'></td>";
                    }
                    if ($cResult == 1) {
                      echo "<td><img src='/img/ok.png' height='20' width='20'></td>";
                    }
                    else {
                      echo "<td><img src='/img/remove.png' height='20' width='20'></td>";
                    }
                    if ($dResult == 1) {
                      echo "<td><img src='/img/ok.png' height='20' width='20'></td>";
                    }
                    else {
                      echo "<td><img src='/img/remove.png' height='20' width='20'></td>";
                    }
                    if ($eResult == 1) {
                      echo "<td><img src='/img/ok.png' height='20' width='20'></td>";
                    }
                    else {
                      echo "<td><img src='/img/remove.png' height='20' width='20'></td>";
                    }
                    if ($fResult == 1) {
                      echo "<td><img src='/img/ok.png' height='20' width='20'></td>";
                    }
                    else {
                      echo "<td><img src='/img/remove.png' height='20' width='20'></td>";
                    }
                    if ($gResult == 1) {
                      echo "<td><img src='/img/ok.png' height='20' width='20'></td>";
                    }
                    else {
                      echo "<td><img src='/img/remove.png' height='20' width='20'></td>";
                    }
                    if ($hResult == 1) {
                      echo "<td><img src='/img/ok.png' height='20' width='20'></td>";
                    }
                    else {
                      echo "<td><img src='/img/remove.png' height='20' width='20'></td>";
                    }
                    if ($iResult == 1) {
                      echo "<td><img src='/img/ok.png' height='20' width='20'></td>";
                    }
                    else {
                      echo "<td><img src='/img/remove.png' height='20' width='20'></td>";
                    }
                    if ($jResult == 1) {
                      echo "<td><img src='/img/ok.png' height='20' width='20'></td>";
                    }
                    else {
                      echo "<td><img src='/img/remove.png' height='20' width='20'></td>";
                    }
                  @endphp
                  <td>{{$ro['totalScore']}}</td>
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
        $('#container-resultOpendata').highcharts( <?php  echo json_encode($chartArrayOpendata) ?>);
        $('#container-subkategori').highcharts( <?php  echo json_encode($chartArraySubkategori) ?>);
    });

</script>
@endsection

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
                  <td>{{$ro['aResult']}}</td>
                  <td>{{$ro['bResult']}}</td>
                  <td>{{$ro['cResult']}}</td>
                  <td>{{$ro['dResult']}}</td>
                  <td>{{$ro['eResult']}}</td>
                  <td>{{$ro['fResult']}}</td>
                  <td>{{$ro['gResult']}}</td>
                  <td>{{$ro['hResult']}}</td>
                  <td>{{$ro['iResult']}}</td>
                  <td>{{$ro['jResult']}}</td>
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
        // $("#klasifikasi").addClass("active");
        $('#container-resultOpendata').highcharts( <?php  echo json_encode($chartArrayOpendata) ?>);
        $('#container-subkategori').highcharts( <?php  echo json_encode($chartArraySubkategori) ?>);
    });

</script>
@endsection

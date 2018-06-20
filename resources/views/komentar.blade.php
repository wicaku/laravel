@extends('master')
@section('title')
HOME - Komentar
@endsection
@section('body')

<div class="ui container">
<div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ url('/') }}"><i class="home icon"></i>Beranda</a> / Komentar</h5></div><br>

<div class="ui top attached tabular menu">
  <a class="item active" data-tab="first">Jumlah Komentar 10 Hari Terakhir</a>
  <a class="item" data-tab="second">Total Komentar Seluruh Pemda</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="first">
  <div id="container-komen"></div>
</div>
<div class="ui bottom attached tab segment" data-tab="second">
  <div id="container-komen-pemda"></div>
</div>

</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#home").addClass("active");
        $('#container-komen').highcharts( <?php  echo json_encode($chartArray) ?>);
        $('#container-komen-pemda').highcharts( <?php  echo json_encode($chartArrayKomentar) ?>);
        $('.menu .item')
          .tab()
        ;
    });
</script>
@endsection

@extends('master')
@section('title')
HOME - Post
@endsection
@section('body')

<div class="ui container">
<div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ url('/') }}"><i class="home icon"></i>Beranda</a> / Posts</h5></div><br>

  <div class="ui top attached tabular menu">
    <a class="item active" data-tab="first">Jumlah Post 10 Hari Terakhir</a>
    <a class="item" data-tab="second">Total Pos Seluruh Pemda</a>
  </div>
  <div class="ui bottom attached tab segment active" data-tab="first">
    <div id="container-post"></div>
  </div>
  <div class="ui bottom attached tab segment" data-tab="second">
    <div id="container-post-pemda"></div>
  </div>

</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#home").addClass("active");
        $('#container-post').highcharts( <?php  echo json_encode($chartArrayPost) ?>);
        $('#container-post-pemda').highcharts( <?php  echo json_encode($chartArrayHitungPost) ?>);
        $('.menu .item')
          .tab()
        ;
    });
</script>
@endsection

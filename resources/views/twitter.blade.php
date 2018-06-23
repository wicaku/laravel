@extends('master')
@section('title')
HOME - Twitter
@endsection
@section('body')

<div class="ui container">
<div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ url('/') }}"><i class="home icon"></i>Beranda</a> / Twitter</h5></div><br>
<div class="ui top attached tabular menu">
  <a class="item active" data-tab="first">Jenis Pos Twitter Seluruh Pemda</a>
  <a class="item" data-tab="second">Engagement Score Jenis Tweet Twitter</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="first">
  <div id="container-tweet-type"></div>
</div>
<div class="ui bottom attached tab segment" data-tab="second">
  <div id="container-tweet-type-engagement"></div>
</div>

</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#home").addClass("active");
        $('#container-tweet-type').highcharts( <?php  echo json_encode($chartArrayTwitterType) ?>);
        $('#container-tweet-type-engagement').highcharts( <?php  echo json_encode($chartArrayTwitterEngagementPostType) ?>);
        $('.menu .item')
          .tab()
        ;
    });
</script>
@endsection

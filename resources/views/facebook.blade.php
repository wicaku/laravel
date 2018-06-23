@extends('master')
@section('title')
HOME - Facebook
@endsection
@section('body')

<div class="ui container">
<div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ url('/') }}"><i class="home icon"></i>Beranda</a> / Facebook</h5></div><br>

<div class="ui top attached tabular menu">
  <a class="item active" data-tab="first">Nilai Facebook Reactions Terbaik</a>
  <a class="item" data-tab="second">Jenis Pos Facebook Seluruh Pemda</a>
  <a class="item" data-tab="third">Engagement Score Jenis Pos Facebook</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="first">
  <div id="container-emoji"></div>
</div>
<div class="ui bottom attached tab segment" data-tab="second">
  <div id="container-post-count"></div>
</div>
<div class="ui bottom attached tab segment" data-tab="third">
  <div id="container-post-type"></div>
</div>

</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#home").addClass("active");
        $('#container-emoji').highcharts( <?php  echo json_encode($chartArrayEmoji) ?>);
        $('#container-post-count').highcharts( <?php  echo json_encode($chartArrayPostType) ?>);
        $('#container-post-type').highcharts( <?php  echo json_encode($chartArrayFacebookEngagementPostType) ?>);
        $('.menu .item')
          .tab()
        ;
    });
</script>
@endsection

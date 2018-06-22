@extends('master')

@section('body')

<div class="ui container">
  <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{route('klasifikasi')}}"><i class="home icon"></i>Klasifikasi / </a><span>{{$pemda->name}}</span></h5></div>
  <br>
  <div class="ui cards grid">
    <div class="card twenty wide column">
      <div class="content">
        <div class="header">
          Klasifikasi Post {{ $pemda->name }}
          @if (($pemda->facebook_resmi))
          <a class="ui icon facebook button" style="float:right" target="_blank" href="http://facebook.com/{{$pemda->facebook_resmi}}"><i class="facebook icon"></i></a>
          @endif
          @if (($pemda->twitter_resmi))
          <a class="ui icon twitter button" style="float:right" target="_blank" href="http://twitter.com/{{$pemda->twitter_resmi}}"><i class="twitter icon"></i></a>
          @endif
          @if (($pemda->youtube_resmi))
          <a class="ui icon youtube button" style="float:right" target="_blank" href="http://youtube.com/channel/{{$pemda->youtube_resmi}}"><i class="youtube icon"></i></a>
          @endif
        </div>
      </div>



    </div>
  </div>

  <div class="ui cards grid">
    <div class="card twenty wide column">
      <div class="content">
        <div class="twenty wide column" id="container-total-klasifikasi-post" style="width:100%; height:400px;"></div>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card twenty wide column">
      <div class="content">
        <div class="twenty wide column" id="container-total-post" style="width:100%; height:400px;"></div>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card twenty wide column">
      <div class="content">
        <div class="twenty wide column" id="container-post-type" style="width:100%; height:400px;"></div>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card twenty wide column">
      <div class="content">
        <div class="twenty wide column" id="container-tweet-type" style="width:100%; height:400px;"></div>
      </div>
    </div>
  </div>


</div>
@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#klasifikasi").addClass("active");
        $('#container-total-klasifikasi-post').highcharts( <?php  echo json_encode($chartArrayTotalKlasifikasiPost) ?>);
        $('#container-total-post').highcharts( <?php  echo json_encode($chartArrayTotalPost) ?>);
        $('#container-post-type').highcharts( <?php  echo json_encode($chartArrayPostType) ?>);
        $('#container-tweet-type').highcharts( <?php  echo json_encode($chartArrayTweetType) ?>);

    });

</script>
@endsection

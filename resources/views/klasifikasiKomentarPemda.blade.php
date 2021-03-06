@extends('master')

@section('body')

<div class="ui container">
  <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{route('klasifikasi')}}"><i class="home icon"></i>Klasifikasi / </a><span>{{$pemda->name}}</span></h5></div>
  <br>
  <div class="ui cards grid">
    <div class="card twenty wide column">
      <div class="content">
        <div class="header">
          Klasifikasi Komentar {{ $pemda->name }}
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
        <div class="twenty wide column" id="container" style="width:100%; height:400px;"></div>
      </div>
    </div>
  </div>

  <div class="ui cards grid">
    <div class="card twenty wide column">
      <div class="content">
        <div class="twenty wide column" id="container-total-komen" style="width:100%; height:400px;"></div>
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
        $('#container').highcharts( <?php  echo json_encode($chartArray) ?>);
        $('#container-total-komen').highcharts( <?php  echo json_encode($chartArrayTotalKomen) ?>);
    });

</script>
@endsection

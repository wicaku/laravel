@extends('master')
@section('title')
HOME - Twitter
@endsection
@section('body')

<div class="ui container">
<div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ url('/') }}"><i class="home icon"></i>Beranda</a> / Twitter</h5></div><br>
  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-tweet_type"></div>
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
        $('#container-tweet_type').highcharts( <?php  echo json_encode($chartArrayTwitterType) ?>);
    });
</script>
@endsection

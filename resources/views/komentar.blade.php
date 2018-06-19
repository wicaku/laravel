@extends('master')
@section('title')
HOME - Komentar
@endsection
@section('body')

<div class="ui container">
<div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ url('/') }}"><i class="home icon"></i>Beranda</a> / Komentar</h5></div><br>
  <div class="ui cards grid">
    <div class="card sixteen wide column">
      <div class="content">
        <div id="container-komen"></div>
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
        $('#container-komen').highcharts( <?php  echo json_encode($chartArray) ?>);
    });
</script>
@endsection

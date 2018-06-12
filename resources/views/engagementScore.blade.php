@extends('master')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><i class="home icon"></i>Engagement Score</h5></div>
    </div>
  </div>

  <table id="engagementTable" class="ui celled table responsive nowrap" style="width:100%">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama Dinas</th>
      <th>Facebook Score</th>
      <th>Twitter Score</th>
      <th>Youtube Score</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($engagement as $eg)
          <tr>
            <td>{{$eg['_id']}}</td>
            <td>{{$eg['name']}}</td>
            <td>{{$eg['engagementScoreFB']}}</td>
            <td>{{$eg['engagementScoreTW']}}</td>
            <td>{{$eg['engagementScoreYT']}}</td>
            <td><a href="{{route('peringkat.engagement.pemda', ['id' => $eg['_id']])}}">Detail</a></td>
          </tr>
    @endforeach
  </tbody>
  </table>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#engagement").addClass("active");
        $('#engagementTable').DataTable();
    });

</script>
@endsection

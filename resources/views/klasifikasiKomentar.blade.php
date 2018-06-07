@extends('master')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><i class="home icon"></i>Klasifikasi</h5></div>
    </div>
  </div>

  <table id="klasifikasiTable" class="ui celled table responsive nowrap" style="width:100%">
  <thead>
    <tr>
      <th>Nama Pemda</th>
      <th>Facebook Resmi</th>
      <th>Twitter Resmi</th>
      <th>Youtube Resmi</th>
      <th>Facebook Influencer</th>
      <th>Twitter Influencer</th>
      <th>Youtube Influencer</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pemdas as $pemda)
          <tr>
            <td>{{$pemda['name']}}</td>
            <td>{{$pemda['facebook_resmi']}}</td>
            <td>{{$pemda['twitter_resmi']}}</td>
            <td>{{$pemda['youtube_resmi']}}</td>
            <td>{{$pemda['facebook_influencer']}}</td>
            <td>{{$pemda['twitter_influencer']}}</td>
            <td>{{$pemda['youtube_influencer']}}</td>
            <td>
              <a href="{{ route('klasifikasi.post', ['id' => $pemda->_id]) }}" class='ui tiny icon blue button' id='edit-button'>Detail Post</a>
              <a href="{{ route('klasifikasi.komentar', ['id' => $pemda->_id]) }}" class='ui tiny icon green button' id='edit-button'>Detail Komentar</a>
            </td>
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
        $("#klasifikasi").addClass("active");
        $('#klasifikasiTable').DataTable();

    });

</script>
@endsection

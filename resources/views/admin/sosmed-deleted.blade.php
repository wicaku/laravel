@extends('master-admin')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('sosmed.pemda') }}"><i class="home icon"></i>Admin / Sosmed Pemda</a><span> / Deleted </span></h5></div>
    </div>
  </div>

  <table id="deleted-pemda" class="ui celled table responsive nowrap">
  <thead>
    <tr>
      <th>Nama Pemda</th>
      <th>Facebook Resmi</th>
      <th>Facebook Influencer</th>
      <th>Twitter Resmi</th>
      <th>Twitter Resmi Number</th>
      <th>Twitter Influencer</th>
      <th>Youtube Resmi</th>
      <th>Youtube Influencer</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pemdas as $pemda)
          <tr>
            <td>{{$pemda->name}}</td>
            <td>{{$pemda['facebook_resmi']}}</td>
            <td>{{$pemda['facebook_influencer']}}</td>
            <td>{{$pemda['twitter_resmi']}}</td>
            <td>{{$pemda['twitter_resmi_number']}}</td>
            <td>{{$pemda['twitter_influencer']}}</td>
            <td>{{$pemda['youtube_resmi']}}</td>
            <td>{{$pemda['youtube_influencer']}}</td>
            <td>
              <a href="{{ route('sosmed.pemda.deleted.restore', ['id'=> $pemda['_id']])}}" class='ui tiny icon green button' id='view-button'><i class="history icon"></i></a>
              <a href="{{ route('sosned.pemda.deleted.forceDelete', ['id'=> $pemda['_id']])}}" class='ui tiny icon red button' id='view-button'><i class="ban icon"></i></a>
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
        $('#deleted-pemda').DataTable();
        $('#tambah-button').click(function(){
          $('#tambah-modal').modal('show');
        });
        $("#kategorisasi-admin").addClass("active");
    });
</script>
@endsection

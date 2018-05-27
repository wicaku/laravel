@extends('master-admin')

@section('body')
<div class="ui container">
  <div class="ui grid">
    <div class="two column row">
      <div class="left floated column"><h5 class="ui header" style="margin-top:10px"><a href="{{ route('admin.dashboard') }}"><i class="home icon"></i>Admin</a><span> / Pemda</span></h5></div>
      <div class="two column row">
        <div class="right floated column"><button class="small ui right floated green button" id="tambah-button"><i class="icon plus"></i>Tambah Pemda</button></div>
        <div class="right floated column"><a href="{{ route('pemda.deleted')}}" class="small ui right floated red button"><i class="icon trash"></i>Deleted Pemda</a></div>
      </div>
    </div>
  </div>

  <table id="pemda" class="ui celled table responsive nowrap" style="width:100%">
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
                <form action="{{ route('sosmed.pemda.destroy', ['id' => $pemda->_id])}}" method="post">
                {{ method_field('delete')}}
                {{ csrf_field() }}
                <a href="{{ route('sosmed.pemda.edit', ['id' => $pemda->_id])}}" class='ui tiny icon blue button' id='edit-button'><i class="edit icon"></i></a>
                <button class='ui tiny icon red button' type="submit"><i class="delete icon"></i></a>
                </form>
            </td>
          </tr>
    @endforeach
  </tbody>
  </table>

</div>

<div class="ui modal" id="tambah-modal">
  <i class="close icon"></i>
  <div class="header">
    Tambah Pemda
  </div>
  <div class="content">
    <form class="ui large form"method="POST" action="{{ route('sosmed.pemda.store') }}">
      @csrf
      <div class="ui left stacked segment">

        <div class="field">
          <label style="text-align:left">Nama Pemda</label>
            <input name="name" placeholder="Nama Pemda">
        </div>

        <h4 class="ui dividing header" style="text-align:left">Facebook</h4>

        <div class="two fields">
          <div class="field">
            <label style="text-align:left">Facebook Resmi</label>
            <input name="facebook_resmi" placeholder="Username Facebook Resmi">
          </div>

          <div class="field">
            <label style="text-align:left">Facebook Influencer</label>
            <input name="facebook_influencer" placeholder="Username Facebook Influencer">
          </div>

        </div>

        <h4 class="ui dividing header" style="text-align:left">Twitter</h4>
        <div class="three fields">
          <div class="field">
            <label style="text-align:left">Twitter Resmi</label>
            <input name="twitter_resmi" placeholder="Username Twitter Resmi">
          </div>

          <div class="field">
            <label style="text-align:left">Twitter Resmi Number</label>
            <input name="twitter_resmi_number" placeholder="ID Twitter Resmi">
          </div>

          <div class="field">
            <label style="text-align:left">Twitter Influencer</label>
            <input name="twitter_influencer"  placeholder="Username Twitter Influencer">
          </div>
        </div>

        <h4 class="ui dividing header" style="text-align:left">Youtube</h4>
        <div class="two fields">

          <div class="field">
            <label style="text-align:left">Youtube Resmi</label>
            <input name="youtube_resmi"  placeholder="ID Channel Youtube Resmi">

          </div>

          <div class="field">
            <label style="text-align:left">Youtube Influencer</label>
            <input name="youtube_influencer"  placeholder="ID Channel Youtube Influencer">
          </div>
        </div>
  </div>
  <div class="actions">
    <button type="button" class="ui button cancel">cancel</button>
    <button class="ui button submit ok" type="submit">submit</button>
    {{ csrf_field() }}
    </form>
  </div>
</div>


@endsection
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $('#tambah-button').click(function(){
          $('#tambah-modal').modal('show');
        });
        $('#pemda').DataTable({
            responsive: {
              details: {
                  display: $.fn.dataTable.Responsive.display.modal( {
                      header: function ( row ) {
                          var data = row.data();
                          return 'Details for '+data[0]+' '+data[1];
                      }
                  } ),
                  renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                      tableClass: 'ui table'
                  } )
              }
          }
        });
        $('#tambah-button').click(function(){
          $('#tambah-modal').modal('show');
        });
        $("#kategorisasi-admin").addClass("active");
    });
</script>
@endsection

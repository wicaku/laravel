@extends('master') 
@section('title') Sosial Media @endsection 
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.semanticui.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.semanticui.min.js"></script>
@endsection @section('body')
<div class="ui container">
	<div class="row">
		<div class="ui stackable grid">
			<div class="four wide column">
				@include('data.sosmed.submenu')
			</div>
			<div class="twelve wide column">
				<table id="datatable" class="ui celled table">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Pemda</th>
							<th>Facebook ID</th>
							<th>Twitter ID</th>
							<th>Youtube ID</th>
							<th>Total Score</th>
							<th>Detail</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $item)
						<tr>
							<td> {{$item->id_pemda}} </td>
							<td> {{$item->nama_pemda}} </td>
							<td> {{$item->fb_id}} </td>
							<td> {{$item->tw_id}} </td>
							<td> {{$item->yt_id}} </td>
							<td> {{$item->totalscore}} </td>
							<td>
								<a href="#">Detail Here</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection 
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#datasocmed").addClass("active");
        $("#subDataNilai").addClass("active teal");
		$('#datatable').DataTable({
			"autoWidth": false
		});
    });
</script>
@endsection
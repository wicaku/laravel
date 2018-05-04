@extends('master') 
@section('title') Website @endsection 
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.semanticui.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.semanticui.min.js"></script>
@endsection @section('body')
<div class="ui container">
	<div class="row">
		<div class="ui stackable grid">
			<div class="four wide column">
				@include('data.website.submenu')
			</div>
			<div class="twelve wide column">
				<table id="datatable" class="ui celled table">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Pemda</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $i => $item)
						<tr>
							<td> {{$i+1}} </td>
							<td> {{$item->nama_pemda}} </td>
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
        $("#dataweb").addClass("active");
        $("#subDataBelum").addClass("active teal");
		$('#datatable').DataTable({
			"autoWidth": false
		});
    });
</script>
@endsection
@extends('master') 
@section('title')
SUPER PANEL
@endsection 
@section('body')
<div class="ui container">
	<h1>WVS SETTINGS</h1>
	<table>
	@foreach($data as $singleItem)
	@foreach($singleItem as $key => $value)
	<tr>
		<td>
		{{ $key }} 
		</td>
		<td>
		{{ $value }}
		</td>
	</tr>
	@endforeach
	@endforeach
	</table>
</div>
@endsection @section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
    });

</script>
@endsection
@extends('master') 
@section('title')
{{ $metodologi->name}}
@endsection
@section('body')
<div class="ui container">
	<h1>{{ $metodologi->name}}</h1>
	<p>{!! nl2br($metodologi->body) !!}</p>
</div>
@endsection 
@section('script')
<script>
	$(document).ready(function () {
        $('.ui.dropdown').dropdown();
		$("#meta{{ $metodologi->version }}").addClass("active");
    });
</script>
@endsection
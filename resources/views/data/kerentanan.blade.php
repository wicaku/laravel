@extends('master')
@section('title')
Kerentanan
@endsection
@section('body')
    
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#datavuln").addClass("active");
    });
</script>
@endsection
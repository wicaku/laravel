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
        $("#vuln").addClass("active");
    });
</script>
@endsection
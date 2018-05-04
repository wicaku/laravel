@extends('master')
@section('title')
HOME
@endsection
@section('body')
    
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#home").addClass("active");
    });
</script>
@endsection
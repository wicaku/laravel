@extends('master')
@section('title')
Website
@endsection
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.material.min.css" integrity="sha256-awvg5JTMvPu9CHWshhn2lWQiWWChetFusNMOngDBBaM=" crossorigin="anonymous" />
@endsection
@section('body')
    <div class="ui container">
    @include('data.website.submenu')
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $("#dataweb").addClass("active");
        $("#subDataTerbaru").addClass("active teal");
    });
</script>
@endsection
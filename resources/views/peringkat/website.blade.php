@extends('master')
@section('title')
Website
@endsection


@section('head')
    {{--  {!! Charts::styles() !!}  --}}
    {!! Charts::styles(['highchats']) !!}
@endsection


@section('body')
<div class="ui container">
    {!! $chart->html() !!}
    <table id="datatable" class="ui compact celled table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pemda</th>
                <th>Link URL</th>
                <th>Totalscore</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $item)
            <tr>
                <td> {{$i+1}} </td>
                <td> {{$item->nama_pemda}} </td>
                <td> {{$item->url}} </td>
                <td> {{$item->totalscore}} </td>
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
        $("#web").addClass("active");
    });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/5.0.7/highcharts.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/5.0.7/js/modules/offline-exporting.js"></script>
{{--  {!! Charts::scripts(['highcharts']) !!}  --}}
{!! $chart->script() !!}
@endsection
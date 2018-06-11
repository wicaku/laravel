<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\pemdaModel;
use App\Model\resultOpendataModel;
use App\Model\bpsOpendataModel;
use App\Model\ckanOpendataModel;

class OpendataController extends Controller
{
    //
    public function index() {
        date_default_timezone_set("Asia/Jakarta");
        $pemda = pemdaModel::all()->count();
        $total_bps_pemda = pemdaModel::where('bps_pemda', '!=', "")->count('bps_pemda');
        $active_bps_pemda = bpsOpendataModel::distinct('id_pemda')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count('id_pemda');
        $total_scored_bps = bpsOpendataModel::whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $total_ckan_pemda = pemdaModel::where('ckan_pemda', '!=', "")->count('ckan_pemda');
        $active_ckan_pemda = ckanOpendataModel::distinct('id_pemda')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count('id_pemda');
        $total_scored_ckan = ckanOpenDataModel::whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $last_result_date = resultOpendataModel::select('date')->orderByDesc('date')->first();

        $top10resultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('pemda.nama_pemda', 'pemda.tipe', 'pemda.bps_pemda', 'pemda.ckan_pemda', 'result_opendata.id_pemda', 'result_opendata.id_kategori', 'result_opendata.totalScore')->where('id_kategori', '=', "D11")->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->orderBy('id_pemda')->take(10)->get();

        $allResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('pemda.nama_pemda', 'pemda.tipe', 'pemda.bps_pemda', 'pemda.ckan_pemda', 'result_opendata.id_pemda', 'result_opendata.id_kategori', 'result_opendata.totalScore')->where('id_kategori', '=', "D11")->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->orderBy('id_pemda')->get();

        $provResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('pemda.nama_pemda', 'pemda.tipe', 'result_opendata.id_pemda', 'result_opendata.id_kategori', 'result_opendata.totalScore')->where('id_kategori', '=', "D11")->where('tipe', '=', "PROV")->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->orderBy('id_pemda')->take(10)->get();

        $kabResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('pemda.nama_pemda', 'pemda.tipe', 'result_opendata.id_pemda', 'result_opendata.id_kategori', 'result_opendata.totalScore')->where('id_kategori', '=', "D11")->where('tipe', '=', "KAB")->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->orderBy('id_pemda')->take(10)->get();

        $kotaResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('pemda.nama_pemda', 'pemda.tipe', 'result_opendata.id_pemda', 'result_opendata.id_kategori', 'result_opendata.totalScore')->where('id_kategori', '=', "D11")->where('tipe', '=', "KOTA")->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->orderBy('id_pemda')->take(10)->get();
        
        foreach ($top10resultOpendata as $top10result) {
            $idPemdaTop10[] = $top10result['id_pemda'];
            $namaPemdaTop10[] = $top10result['nama_pemda'];
            $tipePemdaTop10[] = $top10result['tipe'];
            $linkBPSTop10[] = $top10result['bps_pemda'];
            $linkCKANTop10[] = $top10result['ckan_pemda'];
            $totalScoreTop10[] = $top10result['totalScore'];
        }

        foreach ($allResultOpendata as $allResult) {
            $idPemdaAll[] = $allResult['id_pemda'];
            $namaPemdaAll[] = $allResult['nama_pemda'];
            $tipePemdaAll[] = $allResult['tipe'];
            $linkBPSAll[] = $allResult['bps_pemda'];
            $linkCKANAll[] = $allResult['ckan_pemda'];
            $totalScoreAll[] = $allResult['totalScore'];
        }

        foreach ($provResultOpendata as $provResult) {
            $idPemdaProv[] = $provResult['id_pemda'];
            $namaPemdaProv[] = $provResult['nama_pemda'];
            $tipePemdaProv[] = $provResult['tipe'];
            $totalScoreProv[] = $provResult['totalScore'];
        }

        foreach ($kabResultOpendata as $kabResult) {
            $idPemdaKab[] = $kabResult['id_pemda'];
            $namaPemdaKab[] = $kabResult['nama_pemda'];
            $tipePemdaKab[] = $kabResult['tipe'];
            $totalScoreKab[] = $kabResult['totalScore'];
        }

        foreach ($kotaResultOpendata as $kotaResult) {
            $idPemdaKota[] = $kotaResult['id_pemda'];
            $namaPemdaKota[] = $kotaResult['nama_pemda'];
            $tipePemdaKota[] = $kotaResult['tipe'];
            $totalScoreKota[] = $kotaResult['totalScore'];
        }

        //Top 10 Pemda Chart
        $chartArrayTop10Result ["chart"] = array (
            "type" => "column"
        );
        $chartArrayTop10Result ["title"] = array (
            "text" => "10 Hasil Penilaian Open Data Kategori Kesehatan Terbaik milik Pemerintah Daerah"
        );
        $chartArrayTop10Result ["credits"] = array (
            "enabled" => true
        );

        for($i = 0; $i < count ( $namaPemdaTop10 ); $i++) {
        $chartArrayTop10Result ["xAxis"] = array (
                "categories" => $namaPemdaTop10
        );
        }

        $chartArrayTop10Result ["tooltip"] = array (
            "valueSuffix" => ""
        );

        for($i = 0; $i < count($tipePemdaTop10); $i++) {
            if ($tipePemdaTop10[$i] == "PROV") {
                $top10Colors [] = ("red");
            }
            elseif ($tipePemdaTop10[$i] == "KOTA") {
                $top10Colors [] = ("blue");
            }
            elseif ($tipePemdaTop10[$i] == "KAB") {
                $top10Colors [] = ("green");
            }
            else{
                $top10Colors [] = ("grey");
            }
        }

        $chartArrayTop10Result ["plotOptions"] = array (
            "column" => [
                "stacking" => 'normal',
                "dataLabels" => [
                    'enabled' => false,
                    'color' => 'white'
                ],
                "colors" => $top10Colors,
                "colorByPoint" => true
            ]
        );

        $chartArrayTop10Result ["yAxis"] = array (
            "min" => 0,
            "max" => 100,
            "title" => [
                "text" => 'Total Score'
            ],
            "stackLabels" => [
                "enabled" => true
            ]
        );

        $chartArrayTop10Result ["series"] [] = array (
            "name" => "Skor Total",
            "showInLegend" => false,
            "data" => $totalScoreTop10,
        );

        //All Pemda Chart
        $chartArrayAllResult ["chart"] = array (
            "type" => "column"
        );
        $chartArrayAllResult ["title"] = array (
            "text" => "Hasil Penilaian Open Data Kategori Kesehatan Seluruh Pemerintah Daerah"
        );
        $chartArrayAllResult ["credits"] = array (
            "enabled" => true
        );

        for($i = 0; $i < count ( $namaPemdaAll ); $i++) {
        $chartArrayAllResult ["xAxis"] = array (
                "categories" => $namaPemdaAll
        );
        }

        $chartArrayAllResult ["tooltip"] = array (
            "valueSuffix" => ""
        );
        
        for($i = 0; $i < count($tipePemdaAll); $i++) {
            if ($tipePemdaAll[$i] == "PROV") {
                $allPemdaColors [] = ("red");
            }
            elseif ($tipePemdaAll[$i] == "KOTA") {
                $allPemdaColors [] = ("blue");
            }
            elseif ($tipePemdaAll[$i] == "KAB") {
                $allPemdaColors [] = ("green");
            }
            else{
                $allPemdaColors [] = ("grey");
            }
        }

        $chartArrayAllResult ["plotOptions"] = array (
            "column" => [
                "stacking" => 'normal',
                "dataLabels" => [
                    'enabled' => false,
                    'color' => 'white'
                ],
                "colors" => $allPemdaColors,
                "colorByPoint" => true
            ]
        );

        $chartArrayAllResult ["yAxis"] = array (
            "min" => 0,
            "max" => 100,
            "title" => [
                "text" => 'Total Score'
            ],
            "stackLabels" => [
                "enabled" => false
            ]
        );

        $chartArrayAllResult ["series"] [] = array (
            "name" => "Skor Total",
            "showInLegend" => false,
            "data" => $totalScoreAll,
        );

        //Prov Pemda Chart
        $chartArrayProvResult ["chart"] = array (
            "type" => "bar"
        );
        $chartArrayProvResult ["title"] = array (
            "text" => "Provinsi dengan Open Data Kategori Kesehatan Terbaik"
        );
        $chartArrayProvResult ["credits"] = array (
            "enabled" => true
        );

        for($i = 0; $i < count ( $namaPemdaProv ); $i++) {
        $chartArrayProvResult ["xAxis"] = array (
                "categories" => $namaPemdaProv
        );
        }

        $chartArrayProvResult ["tooltip"] = array (
            "valueSuffix" => ""
        );

        $chartArrayProvResult ["plotOptions"] = array (
            "column" => [
                "stacking" => 'normal',
                "dataLabels" => [
                    'enabled' => false,
                    'color' => 'white'
                ],
            ]
        );

        $chartArrayProvResult ["yAxis"] = array (
            "min" => 0,
            "max" => 100,
            "title" => [
                "text" => 'Total Score'
            ],
            "stackLabels" => [
                "enabled" => false
            ]
        );

        $chartArrayProvResult ["series"] [] = array (
            "name" => "Skor Total",
            "color" => "red",
            "showInLegend" => false,
            "data" => $totalScoreProv,
        );

        //Kab Pemda Chart
        $chartArrayKabResult ["chart"] = array (
            "type" => "bar"
        );
        $chartArrayKabResult ["title"] = array (
            "text" => "Kabupaten dengan Open Data Kategori Kesehatan Terbaik"
        );
        $chartArrayKabResult ["credits"] = array (
            "enabled" => true
        );

        for($i = 0; $i < count ( $namaPemdaKab ); $i++) {
        $chartArrayKabResult ["xAxis"] = array (
                "categories" => $namaPemdaKab
        );
        }

        $chartArrayKabResult ["tooltip"] = array (
            "valueSuffix" => ""
        );

        $chartArrayKabResult ["plotOptions"] = array (
            "column" => [
                "stacking" => 'normal',
                "dataLabels" => [
                    'enabled' => false,
                    'color' => 'white'
                ],
            ]
        );

        $chartArrayKabResult ["yAxis"] = array (
            "min" => 0,
            "max" => 100,
            "title" => [
                "text" => 'Total Score'
            ],
            "stackLabels" => [
                "enabled" => false
            ]
        );

        $chartArrayKabResult ["series"] [] = array (
            "name" => "Skor Total",
            "color" => "green",
            "showInLegend" => false,
            "data" => $totalScoreKab,
        );

        //Kota Pemda Chart
        $chartArrayKotaResult ["chart"] = array (
            "type" => "bar"
        );
        $chartArrayKotaResult ["title"] = array (
            "text" => "Kota denan Open Data Kategori Kesehatan Terbaik"
        );
        $chartArrayKotaResult ["credits"] = array (
            "enabled" => true
        );

        for($i = 0; $i < count ( $namaPemdaKota ); $i++) {
        $chartArrayKotaResult ["xAxis"] = array (
                "categories" => $namaPemdaKota
        );
        }

        $chartArrayKotaResult ["tooltip"] = array (
            "valueSuffix" => ""
        );

        $chartArrayKotaResult ["plotOptions"] = array (
            "column" => [
                "stacking" => 'normal',
                "dataLabels" => [
                    'enabled' => false,
                    'color' => 'white'
                ],
            ]
        );

        $chartArrayKotaResult ["yAxis"] = array (
            "min" => 0,
            "max" => 100,
            "title" => [
                "text" => 'Total Score'
            ],
            "stackLabels" => [
                "enabled" => false
            ]
        );

        $chartArrayKotaResult ["series"] [] = array (
            "name" => "Skor Total",
            "color" => "blue",
            "showInLegend" => false,
            "data" => $totalScoreKota,
        );

        return view('opendata', ['pemda' => $pemda, 'total_bps_pemda' => $total_bps_pemda, 'active_bps_pemda' => $active_bps_pemda, 'total_scored_bps' => $total_scored_bps, 'total_ckan_pemda' => $total_ckan_pemda, 'active_ckan_pemda' => $active_ckan_pemda, 'total_scored_ckan' => $total_scored_ckan, 'last_result_date' => $last_result_date['date'], 'top10resultOpendata' => $top10resultOpendata])->withchartArrayTop10Result($chartArrayTop10Result)->withchartArrayAllResult($chartArrayAllResult)->withChartArrayProvResult($chartArrayProvResult)->withChartArrayKabResult($chartArrayKabResult)->withChartArrayKotaResult($chartArrayKotaResult);
    }

}

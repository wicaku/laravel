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
    public function Stand_Deviation($arr)
    {
        $num_of_elements = count($arr);

        $variance = 0.0;

                // calculating mean using array_sum() method
        $average = array_sum($arr)/$num_of_elements;

        foreach($arr as $i)
        {
            // sum of squares of differences between
                        // all numbers and means.
            $variance += pow(($i - $average), 2);
        }

        return (float)sqrt($variance/$num_of_elements);
    }

    public function average($arr)
    {
      $num_of_elements = count($arr);

      $variance = 0.0;

              // calculating mean using array_sum() method
      $average = array_sum($arr)/$num_of_elements;

      return round($average,2);
    }

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

        $highestResultOpendata = resultOpendataModel::select('totalScore')->where('id_kategori', '=', "D11")->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->first();
        
        $top10resultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('pemda.nama_pemda', 'pemda.tipe', 'pemda.bps_pemda', 'pemda.ckan_pemda', 'result_opendata.id_pemda', 'result_opendata.id_kategori', 'result_opendata.totalScore')->where('id_kategori', '=', "D11")->where('totalScore', '=', $highestResultOpendata['totalScore'])->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->orderBy('id_pemda')->get();

        $allResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('pemda.nama_pemda', 'pemda.tipe', 'pemda.bps_pemda', 'pemda.ckan_pemda', 'result_opendata.id_pemda', 'result_opendata.id_kategori', 'result_opendata.totalScore')->where('id_kategori', '=', "D11")->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->orderBy('id_pemda')->get();

        $highestProvResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('totalScore')->where('id_kategori', '=', "D11")->where('tipe', '=', "PROV")->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->first();

        $provResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('pemda.nama_pemda', 'pemda.tipe', 'result_opendata.id_pemda', 'result_opendata.id_kategori', 'result_opendata.totalScore')->where('id_kategori', '=', "D11")->where('tipe', '=', "PROV")->where('totalScore', '=', $highestProvResultOpendata['totalScore'])->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->orderBy('id_pemda')->get();

        $highestKabResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('totalScore')->where('id_kategori', '=', "D11")->where('tipe', '=', "KAB")->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->first();

        $kabResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('pemda.nama_pemda', 'pemda.tipe', 'result_opendata.id_pemda', 'result_opendata.id_kategori', 'result_opendata.totalScore')->where('id_kategori', '=', "D11")->where('tipe', '=', "KAB")->where('totalScore', '=', $highestKabResultOpendata['totalScore'])->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->orderBy('id_pemda')->get();

        $highestKotaResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('totalScore')->where('id_kategori', '=', "D11")->where('tipe', '=', "KOTA")->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->first();

        $kotaResultOpendata = resultOpendataModel::join('pemda', 'result_opendata.id_pemda', '=', 'pemda.id_pemda')->select('pemda.nama_pemda', 'pemda.tipe', 'result_opendata.id_pemda', 'result_opendata.id_kategori', 'result_opendata.totalScore')->where('id_kategori', '=', "D11")->where('tipe', '=', "KOTA")->where('totalScore', '=', $highestKotaResultOpendata['totalScore'])->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('totalScore')->orderBy('id_pemda')->get();

        foreach ($top10resultOpendata as $top10result) {
            $idPemdaTop10[] = $top10result['id_pemda'];
            $namaPemdaTop10[] = $top10result['nama_pemda'];
            $tipePemdaTop10[] = $top10result['tipe'];
            $top10result['bps_pemda'] .= "/subject/30/kesehatan.html#subjekViewTab3";
            $totalScoreTop10[] = $top10result['totalScore'];
        }

        foreach ($allResultOpendata as $allResult) {
            $idPemdaAll[] = $allResult['id_pemda'];
            $namaPemdaAll[] = $allResult['nama_pemda'];
            $tipePemdaAll[] = $allResult['tipe'];
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
            "text" => "Hasil Penilaian Open Data Kategori Kesehatan Terbaik milik Pemerintah Daerah"
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

        //All Pemda Chart std
        $rata = $this->average($totalScoreAll);
        $std = $this->Stand_Deviation($totalScoreAll);

        $chartArrayAllResultSTD ["chart"] = array (
            "type" => "column"
        );
        $chartArrayAllResultSTD ["title"] = array (
            "text" => "Hasil Penilaian Open Data Kategori Kesehatan Seluruh Pemerintah Daerah"
        );
        $chartArrayAllResultSTD ["credits"] = array (
            "enabled" => true
        );

        for($i = 0; $i < count ( $namaPemdaAll ); $i++) {
        $chartArrayAllResultSTD ["xAxis"] = array (
                "categories" => $namaPemdaAll
        );
        }

        $chartArrayAllResultSTD ["tooltip"] = array (
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

        $chartArrayAllResultSTD ["plotOptions"] = array (
            "column" => [
                "stacking" => 'normal',
                "dataLabels" => [
                    'enabled' => false,
                    'color' => 'white'
                ],
                // "colors" => $allPemdaColors,
                // "colorByPoint" => true
            ]
        );

        $chartArrayAllResultSTD ["yAxis"] = array (
            "min" => 0,
            "max" => 100,
            "title" => [
                "text" => 'Total Score'
            ],
            "stackLabels" => [
                "enabled" => false
            ],
            "plotLines" => [array(
            	"value" => $rata,
              "color" => 'green',
              "dashStyle" => 'shortdash',
              "width" => 2,
              "label" => [
                "text" => 'Rata-rata = '.$rata,
                "align" => 'right',
                ]
            )]
        );

        $chartArrayAllResultSTD ["series"] [] = array (
            "name" => "Skor Total",
            "showInLegend" => false,
            "data" => $totalScoreAll,
            "zones" => [array(
              "value" => $rata-$std,
              "color" => '#002db3'
            ), array(
              "value" => $rata+$std,
            ), array(
              "value" => $rata + (2*$std),
              "color" => '#002db3'
            ), array(
              "value" => $rata + (3*$std),
              "color" => '#00ff55'
            )]
        );

        $chartArrayAllResultSTD ["series"] [] = array (
          "name" => '+- 1 SD',
          "color" => '#80bfff',
          "data" => [],
          "marker" => [
            "symbol" => 'square',
            "radius" => 12
            ],
        );
        $chartArrayAllResultSTD ["series"] [] = array (
          "name" => '+- 2 SD',
          "color" => '#002db3',
          "data" =>[],
          "marker" => [
            "symbol" => 'square',
            "radius" => 12
            ],
        );
        $chartArrayAllResultSTD ["series"] [] = array (
          "name" => '+- 3 SD',
          "color" => '#00ff55',
          "data" => [],
          "marker" => [
            "symbol" => 'square',
            "radius" => 12
            ],
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
            "text" => "Kota dengan Open Data Kategori Kesehatan Terbaik"
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

        return view('opendata', ['pemda' => $pemda, 'total_bps_pemda' => $total_bps_pemda, 'active_bps_pemda' => $active_bps_pemda, 'total_scored_bps' => $total_scored_bps, 'total_ckan_pemda' => $total_ckan_pemda, 'active_ckan_pemda' => $active_ckan_pemda, 'total_scored_ckan' => $total_scored_ckan, 'last_result_date' => $last_result_date['date'], 'top10resultOpendata' => $top10resultOpendata])->withchartArrayTop10Result($chartArrayTop10Result)->withchartArrayAllResult($chartArrayAllResult)->withchartArrayAllResultSTD($chartArrayAllResultSTD)->withChartArrayProvResult($chartArrayProvResult)->withChartArrayKabResult($chartArrayKabResult)->withChartArrayKotaResult($chartArrayKotaResult);
    }
    public function data() {
        date_default_timezone_set("Asia/Jakarta");
        $listPemda = pemdaModel::all()->sortBy('id_pemda');
        foreach ($listPemda as $lp) {

            $idPemda = $lp['id_pemda'];
            $lp['bps_pemda'] .= "/subject/30/kesehatan.html#subjekViewTab3";
            $lp['bps_dataset'] = bpsOpendataModel::where('id_pemda', '=', $idPemda)->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
            $lp['ckan_dataset'] = ckanOpendataModel::where('id_pemda', '=', $idPemda)->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
            $resultScore = resultOpendataModel::select('totalScore')->where('id_pemda', '=', $idPemda)->where('id_kategori', '=', 'D11')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->orderByDesc('date')->first();
            $lp['totalScore'] = $resultScore['totalScore'];
        }

        $countLifeBPS = bpsOpendataModel::where('subkategori', '=', 'Mortality and Survival Rates')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countAccessBPS = bpsOpendataModel::where('subkategori', '=', 'Level of Access to Health Care')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countVaccineBPS = bpsOpendataModel::where('subkategori', '=', 'Levels of Vaccination')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countOutcomesBPS = bpsOpendataModel::where('subkategori', '=', 'Health Care Outcomes')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countLifeCKAN = ckanOpendataModel::where('subkategori', '=', 'Mortality and Survival Rates')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countAccessCKAN = ckanOpendataModel::where('subkategori', '=', 'Level of Access to Health Care')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countVaccineCKAN = ckanOpendataModel::where('subkategori', '=', 'Levels of Vaccination')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countOutcomesCKAN = ckanOpendataModel::where('subkategori', '=', 'Health Care Outcomes')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();

        //Subkategori Dataset Chart
        $chartArraySubkategori ["chart"] = array (
            "type" => "pie"
        );
        $chartArraySubkategori ["title"] = array (
            "text" => "Total Dataset berdasarkan Subkategori pada Kategori Kesehatan"
        );
        $chartArraySubkategori ["credits"] = array (
            "enabled" => true
        );

        $chartArraySubkategori ["tooltip"] = array (
            "valueSuffix" => " Dataset"
        );

        $chartArraySubkategori ["plotOptions"] = array (
            "pie" => [
                "shadow" => false,
                "center" => [
                    '50%',
                    '50%'
                ],
            ]
        );

        $chartArraySubkategori ["yAxis"] = array (

            "title" => [
                "text" => 'Julah Dataset'
            ]
        );

        $chartArraySubkategori ["series"][] = array (
            "name" => "Subkategori", "size" => "70%", "data" => [
                    ["name" => "Mortality and Survival Rates", "y" => $countLifeBPS + $countLifeCKAN, "color" => "Red"], ["name" => "Level of Access to Health Care", "y" => $countAccessBPS + $countAccessCKAN, "color" => "DarkGreen"], ["name" => "Levels of Vaccination", "y" => $countVaccineBPS + $countVaccineCKAN, "color" => "Yellow"], ["name" => "Health Care Outcomes", "y" => $countOutcomesBPS + $countOutcomesCKAN, "color" => "Blue"]], "dataLabels" => ["enabled" => false]
        );
        $chartArraySubkategori ["series"][] = array (
            "name" => "Sources", "size" => "90%", "innerSize" => "70%",  "data" => [
                ["name" => "Mortality and Survival Rates (BPS)", "y" => $countLifeBPS, "color" => "HotPink"], ["name" => "Mortality and Survival Rates (CKAN)", "y" => $countLifeCKAN, "color" => "Crimson"], ["name" => "Level of Access to Health Care (BPS)", "y" => $countAccessBPS, "color" => "#6F3"], ["name" => "Level of Access to Health Care (CKAN)", "y" => $countAccessCKAN, "color" => "#6F0"], ["name" => "Levels of Vaccination (BPS)", "y" => $countVaccineBPS, "color" => "#FF6"], ["name" => "Levels of Vaccination (CKAN)", "y" => $countVaccineCKAN, "color" => "#FF3"], ["name" => "Health Care Outcomes (BPS)", "y" => $countOutcomesBPS, "color" => "SkyBlue"], ["name" => "Health Care Outcomes (CKAN)", "y" => $countOutcomesCKAN, "color" => "DeepSkyBlue"]]
            );

        return view('opendataData', ['allData' => $listPemda])->withchartArraySubkategori($chartArraySubkategori);
    }

    public function detail($id) {
        date_default_timezone_set("Asia/Jakarta");
        $pemda = pemdaModel::where('id_pemda', '=', $id)->first();
        // Ambil 12 Bulan terakhir resultOpendata
        $resultOpendata = resultOpendataModel::where('id_pemda', $id)->where('id_kategori', 'D11')->orderByDesc('date')->take(12)->get()->all();
        // Dibalik agar menjadi Ascending urutan Penilaiannya
        $resultOpendata = array_reverse($resultOpendata);
        $scoreOpendata = [];
        $tanggalOpendata = [];

        foreach($resultOpendata as $ro) {
            $ro['tanggal'] = date("F Y", strtotime(($ro['date'])));
            $tanggalOpendata[] = $ro['tanggal'];
            $scoreOpendata[] = $ro['totalScore'];
        }

        $chartArrayOpendata ["chart"] = array (
            "type" => "line"
        );
        $chartArrayOpendata ["title"] = array (
            "text" => "Perkembangan Nilai Implementasi Open Data"
        );
        $chartArrayOpendata ["credits"] = array (
            "enabled" => true
        );

        for($i = 0; $i < count ( $resultOpendata ); $i++) {
        $chartArrayOpendata ["xAxis"][] = array (
                "categories" => $tanggalOpendata
        );
        }

        $chartArrayOpendata ["tooltip"] = array (
            "valueSuffix" => ""
        );

        $chartArrayOpendata ["plotOptions"] = array (
            "line" => [
                "dataLabels" => [
                'enabled' => true,
                'color' => 'black'
                ]
            ]
        );

        $chartArrayOpendata ["yAxis"] = array (
            "min" => 0,
            "max" => 100,
            "title" => [
                "text" => 'Total Score'
            ],
            "stackLabels" => [
                "enabled" => true
            ]
        );

        $chartArrayOpendata ["series"] [] = array (
            "name" => 'Kategori Kesehatan',
            "showInLegends" => false,
            "data" => $scoreOpendata,
        );

        $countLifeBPS = bpsOpendataModel::where('id_pemda', '=', $id)->where('subkategori', '=', 'Mortality and Survival Rates')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countAccessBPS = bpsOpendataModel::where('id_pemda', '=', $id)->where('subkategori', '=', 'Level of Access to Health Care')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countVaccineBPS = bpsOpendataModel::where('id_pemda', '=', $id)->where('subkategori', '=', 'Levels of Vaccination')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countOutcomesBPS = bpsOpendataModel::where('id_pemda', '=', $id)->where('subkategori', '=', 'Health Care Outcomes')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countLifeCKAN = ckanOpendataModel::where('id_pemda', '=', $id)->where('subkategori', '=', 'Mortality and Survival Rates')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countAccessCKAN = ckanOpendataModel::where('id_pemda', '=', $id)->where('subkategori', '=', 'Level of Access to Health Care')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countVaccineCKAN = ckanOpendataModel::where('id_pemda', '=', $id)->where('subkategori', '=', 'Levels of Vaccination')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();
        $countOutcomesCKAN = ckanOpendataModel::where('id_pemda', '=', $id)->where('subkategori', '=', 'Health Care Outcomes')->whereYear('date', '=', date('Y'))->whereMonth('date', '=', date('m'))->count();

        $chartArraySubkategori ["chart"] = array (
            "type" => "pie"
        );
        $chartArraySubkategori ["title"] = array (
            "text" => "Jumlah Dataset berdasarkan Subkategori pada Kategori Kesehatan"
        );
        $chartArraySubkategori ["credits"] = array (
            "enabled" => true
        );

        $chartArraySubkategori ["tooltip"] = array (
            "valueSuffix" => " Dataset"
        );

        $chartArraySubkategori ["plotOptions"] = array (
            "pie" => [
                "shadow" => false,
                "center" => [
                    '50%',
                    '50%'
                ],
            ]
        );

        $chartArraySubkategori ["yAxis"] = array (

            "title" => [
                "text" => 'Julah Dataset'
            ]
        );

        $chartArraySubkategori ["series"][] = array (
            "name" => "Subkategori", "size" => "70%", "data" => [
                    ["name" => "Mortality and Survival Rates", "y" => $countLifeBPS + $countLifeCKAN, "color" => "Red"], ["name" => "Level of Access to Health Care", "y" => $countAccessBPS + $countAccessCKAN, "color" => "DarkGreen"], ["name" => "Levels of Vaccination", "y" => $countVaccineBPS + $countVaccineCKAN, "color" => "Yellow"], ["name" => "Health Care Outcomes", "y" => $countOutcomesBPS + $countOutcomesCKAN, "color" => "Blue"]]
        );

        return view('opendataDetail', ['pemda' => $pemda, 'resultOpendata' => $resultOpendata])->withChartArrayOpendata($chartArrayOpendata)->withChartArraySubkategori($chartArraySubkategori);

    }

}

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

        return view('opendata', ['pemda' => $pemda, 'total_bps_pemda' => $total_bps_pemda, 'active_bps_pemda' => $active_bps_pemda, 'total_scored_bps' => $total_scored_bps, 'total_ckan_pemda' => $total_ckan_pemda, 'active_ckan_pemda' => $active_ckan_pemda, 'total_scored_ckan' => $total_scored_ckan, 'last_result_date' => $last_result_date['date']]);
    }

}

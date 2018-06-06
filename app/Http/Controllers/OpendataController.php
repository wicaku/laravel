<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\pemdaModel;
use App\Model\resultOpendataModel;

class OpendataController extends Controller
{
    //
    public function index() {
        $pemda = pemdaModel::all();
        $resultOpendata = resultOpendataModel::all();
        dd($resultOpendata);
    }

}

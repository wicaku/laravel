<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
///* HOME *///
Route::get('/', function () {
    return view('welcome');
});
Route::get('/tentang', function () {
    return view('tentang');
});

///* Ranking *///
Route::get('/peringkat/website', function () {
    //$data = DB::table('viewTotalScore')->limit(10)->get();
    $data = App\viewWebScore::take(10)->get();
    $chart = Charts::create('bar', 'highcharts')
                 ->title('Top 10 Website')
                 ->elementLabel('Total Score')
                 ->labels($data->pluck('nama_pemda'))
                 ->values($data->pluck('totalscore'))
                 ->responsive(true);
    //dd($data);
    return view('peringkat/website', compact('data','chart'));
});
Route::get('/peringkat/sosial-media', function () {
    $data = App\viewSosmedScore::take(10)->get();
    $chart = Charts::create('bar', 'highcharts')
                 ->title('Top 10 Sosmed')
                 ->elementLabel('Total Score')
                 ->labels($data->pluck('nama_pemda'))
                 ->values($data->pluck('totalscore'))
                 ->responsive(true);
    return view('peringkat/sosial-media', compact('data','chart'));
});
Route::get('/peringkat/kerentanan', function () {
    return view('peringkat/kerentanan');
});

///* Metodologi *///
Route::get('/metodologi/{id}', function ($id) {
    $metodologi = DB::table('metodologi')->find($id);

    return view('metodologi', compact('metodologi'));
});

///* Data Website *///
Route::get('/data/website', function () {
    $data = App\viewWebScore::all();
    //dd($data);
    return view('data/website/nilai', compact('data'));
});
Route::get('/data/website-geoip', function () {
    $data = DB::table('viewGeoIP')->get();
    //dd($data);
    return view('data/website/geoip', compact('data'));
});
Route::get('/data/website-masalah', function () {
    //$datenow = date("Y-m-d");    //the real one
    $datenow = '2017-11-20';     //dummy
    $sql = "CALL `selectMasalahWebsite`('".$datenow."')";
    $data = DB::select($sql);
    //dd($data);
    return view('data/website/masalah', compact('data'));
});
Route::get('/data/website-belum', function () {
    $data = App\viewBelumAdaWebsite::all();
    //dd($data);
    return view('data/website/belum', compact('data'));
});
Route::get('/data/website-terbaru', function () {
    //$data = DB::select('CALL `selectTotalScore`();');
    //dd($data);
    return view('data/website/terbaru', compact('data'));
});

///* Data Sosial Media *///
Route::get('/data/sosial-media', function () {
    $data = App\viewSosmedScore::all();

    return view('data/sosmed/nilai', compact('data'));
});
Route::get('/data/sosial-media-belum', function () {
    $data = App\viewBelumAdaSosmed::all();

    return view('data/sosmed/belum', compact('data'));
});
Route::get('/data/sosial-media-terbaru', function () {
    //$data = DB::select('CALL `selectTotalScore`();');
    //dd($data);
    return view('data/sosmed/terbaru', compact('data'));
});

///* Data Kerentanan *///
Route::get('/data/kerentanan', function () {
    return view('data/kerentanan');
});

Route::get('panel/wvs', function () {
    $data = DB::select('SELECT `http.user_agent`, `http.request_timeout`, `http.request_redirect_limit`, `http.request_concurrency`, `http.request_queue_size`, `http.request_headers`, `http.response_max_size`, `scope.dom_depth_limit`, `scope.exclude_file_extensions`, `scope.exclude_path_patterns`, `scope.exclude_content_patterns`, `scope.include_subdomains`, `scope.directory_depth_limit`, `scope.exclude_binaries`, `scope.auto_redundant_paths`, `scope.https_only`, `browser_cluster.pool_size`, `browser_cluster.job_timeout`, `browser_cluster.worker_time_to_live`, `browser_cluster.ignore_images`, `audit.links`, `audit.forms`, `audit.headers`, `plugins` FROM `jsonSettings` ');
    // dd($data);
    return view('panel/wvs', compact('data'));
});
Auth::routes();

Route::get('/kategorisasi', 'HomeController@index')->name('kategorisasi');
Route::get('/kategorisasi-admin', 'AdminController@index')->name('kategorisasi.admin');

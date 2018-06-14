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
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'welcomeController@index');

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

Route::post('/kategorisasi/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/kategorisasi/', 'Auth\LoginController@showLoginForm')->name('kategorisasi.not.login');
Route::get('/kategorisasi/{id}', 'KategorisasiController@index')->name('kategorisasi');
Route::get('/kategorisasi/{id}/dinas', 'DinasController@index')->name('dinas');
Route::get('/kategorisasi/{id}/rekomendasi', 'RekomendasiController@index')->name('rekomendasi');

Route::get('/klasifikasi', 'KlasifikasiController@index')->name('klasifikasi');
Route::get('/klasifikasi/komentar/{id}', 'KlasifikasiController@klasifikasiKomentarPemda')->name('klasifikasi.komentar');
Route::get('/klasifikasi/post/{id}', 'KlasifikasiController@klasifikasiPostPemda')->name('klasifikasi.post');

Route::get('/peringkat/engagement/', 'engagementScoreController@index')->name('peringkat.engagement');
Route::get('/peringkat/engagement/{id}', 'engagementScoreController@engagementPemda')->name('peringkat.engagement.pemda');

Route::get('/kategorisasi/{id}/rekomendasi/{idDinas}/store', 'RekomendasiController@tambahRekomendasi')->name('rekomendasi.tambah');
Route::get('/kategorisasi/{id}/rekomendasi/{idDinas}/delete', 'RekomendasiController@hapusRekomendasi')->name('rekomendasi.hapus');

Route::get('/kategorisasi-admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/kategorisasi-admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/kategorisasi-admin', 'AdminController@index')->name('admin.dashboard');
Route::post('/kategorisasi-admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::get('/kategorisasi-admin/register-pemda', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register.pemda');
Route::post('/kategorisasi-admin/register-pemda', 'Auth\AdminRegisterController@register')->name('admin.register.pemda.register');

Route::post('/kategorisasi/{id}/', 'DinasController@store')->name('tambah.dinas.store');
Route::get('/kategorisasi/tambah_dinas', 'DinasController@showTambahDinas')->name('tambah.dinas');

Route::get('/kategorisasi/{id}/dinas/{idDinas}/edit', 'DinasController@edit')->name('edit.dinas');
Route::post('/kategorisasi/{id}/dinas/', 'DinasController@update')->name('update.dinas');

Route::delete('/kategorisasi/{id}/dinas/{idDinas}', 'DinasController@destroy')->name('delete.dinas');

Route::get('/kategorisasi-admin/pemda', 'PemdaController@index')->name('pemda');
Route::get('/kategorisasi-admin/pemda/deleted', 'PemdaController@showDeleted')->name('pemda.deleted');

Route::get('/kategorisasi-admin/verifikasi', 'AdminVerificationController@index')->name('admin.verifikasi');
Route::get('/kategorisasi-admin/verifikasi/{id}/verified', 'AdminVerificationController@verified')->name('admin.verifikasi.verified');
Route::get('/kategorisasi-admin/verifikasi/{id}/rejected', 'AdminVerificationController@rejected')->name('admin.verifikasi.rejected');

Route::get('/kategorisasi-admin/pemda/deleted/{id}/restore', 'PemdaController@restore')->name('pemda.deleted.restore');
Route::get('/kategorisasi-admin/pemda/deleted/{id}/forceDelete', 'PemdaController@forceDeleted')->name('pemda.deleted.forceDelete');

Route::get('/kategorisasi-admin/pemda/{id}/edit', 'PemdaController@edit')->name('edit.pemda');
Route::post('/kategorisasi-admin/pemda/{id}/', 'PemdaController@update')->name('update.pemda');

Route::get('/kategorisasi-admin/pemda/{id}/dinas', 'PemdaController@showDinas')->name('pemda.dinas');
Route::post('/kategorisasi-admin/pemda/{id}/dinas/store', 'PemdaController@store')->name('pemda.tambah.dinas.store');

Route::get('/kategorisasi-admin/pemda/{id}/dinas/{idDinas}/edit', 'PemdaController@editDinas')->name('pemda.edit.dinas');
Route::post('/kategorisasi-admin/pemda/{id}/dinas/', 'PemdaController@updateDinas')->name('pemda.update.dinas');

Route::delete('/kategorisasi-admin/pemda/{id}/dinas/{idDinas}', 'PemdaController@destroyDinas')->name('pemda.delete.dinas');

Route::delete('/kategorisasi-admin/pemda/{id}', 'PemdaController@destroy')->name('pemda.delete');

Route::get('validasi', 'ValidationController@index')->name('validasi.pemda');

Route::get('/kategorisasi-admin/sosmed', 'SosialMediaPemdaController@index')->name('sosmed.pemda');

Route::get('/kategorisasi-admin/sosmed/deleted', 'SosialMediaPemdaController@showDeleted')->name('sosmed.pemda.deleted');
Route::get('/kategorisasi-admin/sosmed/deleted/{id}/restore', 'SosialMediaPemdaController@restore')->name('sosmed.pemda.deleted.restore');
Route::get('/kategorisasi-admin/sosmed/deleted/{id}/restore', 'SosialMediaPemdaController@forceDeleted')->name('sosmed.pemda.deleted.forceDelete');


Route::get('/kategorisasi-admin/sosmed/{id}', 'SosialMediaPemdaController@edit')->name('sosmed.pemda.edit');
Route::post('/kategorisasi-admin/sosmed/{id}/update', 'SosialMediaPemdaController@update')->name('sosmed.pemda.update');
Route::delete('/kategorisasi-admin/sosmed/{id}/delete', 'SosialMediaPemdaController@destroy')->name('sosmed.pemda.destroy');
Route::post('/kategorisasi-admin/sosmed/store', 'SosialMediaPemdaController@store')->name('sosmed.pemda.store');


Route::get('kategorisasi/{id}/sosmed/edit', 'UserSosialMediaPemdaController@index')->name('user.sosmed.pemda.edit');
Route::post('kategorisasi/{id}/sosmed/update', 'UserSosialMediaPemdaController@update')->name('user.sosmed.pemda.update');

Route::get('opendata', 'opendataController@index')->name('opendata.main');
Route::get('opendata/data/', 'opendataController@data')->name('opendata.data');
Route::get('opendata/detail/{id}', 'opendataController@detail')->name('opendata.detail');
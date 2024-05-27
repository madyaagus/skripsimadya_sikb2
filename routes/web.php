<?php

use App\Http\Controllers\cetakController;
use App\Http\Controllers\contohController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SuksesLoginController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\userController;
use App\Http\Controllers\pangkatController;
use App\Http\Controllers\pegawaiController;
use App\Http\Controllers\terdakwaController;
use App\Http\Controllers\peminjamanbbController;
use App\Http\Controllers\ba_20Controller;
use App\Http\Controllers\ba_23Controller;
use App\Http\Controllers\bensusController;
use App\Http\Controllers\papankontrolController;
use App\Http\Controllers\rekapandatapemusnahanController;
use App\Http\Controllers\rekapandatadikembalikanController;
use App\Http\Controllers\rekapandatabensusController;
use App\Http\Controllers\rekapandatapinjambbController;
use App\Models\pegawai;

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

/** set active side bar */

// ----------------------------- main dashboard ------------------------------//

// -------------------------------- form ------------------------------------//
// Route::controller(FormController::class)->group(function () {
//     Route::get('form/input/page', 'formIndex')->name('form/input/page');
//     Route::post('form/input/save', 'formSaveRecord')->name('form/input/save');
//     Route::get('form/page/view', 'formView')->name('form/page/view');
//     Route::get('form/input/edit/{id}', 'formInputEdit');
//     Route::post('form/input/update', 'formUpdateRecord')->name('form/input/update');
//     Route::post('form/input/delete', 'formDelete')->name('form/input/delete');
//     Route::get('form/update/page', 'formUpdateIndex')->name('form/update/page');

//     Route::post('form/upload/file', 'formFileUpdate')->name('form/upload/file'); // file upload
//     Route::get('view/upload/file', 'formFileView')->name('view/upload/file'); // file view
//     Route::get('download/file/{file_name}', 'fileDownload'); // file download
//     Route::post('download/file/delete', 'fileDelete')->name('download/file/delete'); // file delete

//     Route::get('form/radio/index', 'radioIndex')->name('form/radio/index'); // radio index
//     Route::post('form/radio/save', 'radioSave')->name('form/radio/save'); // radio save

//     Route::get('form/checkbox/index', 'checkboxIndex')->name('form/checkbox/index'); // checkbox index
//     Route::post('form/checkbox/save', 'saveRecordCheckbox')->name('form/checkbox/save'); // checkbox save

// });


// ---- Yang Baru ---- //
function set_active($route) {
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Route::get('/', function () {
    return view('dashboard.dashboard');
})->name('/');

Route::middleware(['guest'])->group(function() {
    Route::get('/login', [SesiController::class, 'index' ])->name('login');
    Route::post('/login', [SesiController::class, 'login' ]);
});

Route::controller(HomeController::class)->group(function () {
    Route::get('dashboard/page', 'index')->name('dashboard/page');
});

Route::get('/home', function() {
    return redirect('/dashboard');
});

Route::get('kontak', function() {
    return view('menu.kontak');
});


Route::middleware(['auth'])->group(function() { 
    Route::get('/dashboard', [SuksesLoginController::class, 'index']);
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
    Route::get('dashboard/stafbb', [SuksesLoginController::class, 'stafbb'])->name('dashboard.stafbb')->middleware('userAkses:stafbb');
    Route::get('/dashboard/kasibb', [SuksesLoginController::class, 'kasibb'])->name('dashboard.kasibb')->middleware('userAkses:kasibb');
    Route::get('/dashboard/kajari', [SuksesLoginController::class, 'kajari'])->name('dashboard.kajari')->middleware('userAkses:kajari');
    Route::get('/dashboard/jaksa', [SuksesLoginController::class, 'jaksa'])->name('dashboard.jaksa')->middleware('userAkses:jaksa');
});

Route::controller(TentangController::class)->group(function () {
    Route::get('/tentang/struktur-organisasi', 'struktur')->name('/tentang/struktur-organisasi');
    Route::get('/tentang/sop', 'sop')->name('/tentang/sop');
});

Route::middleware(['auth'])->group(function() { 
    Route::middleware(['userAkses:stafbb,kajari,kasibb,jaksa'])->group(function () {
        Route::resource('terdakwa', terdakwaController::class);
        Route::resource('peminjaman_bb', peminjamanbbController::class);
    });

    Route::middleware(['userAkses:stafbb,kajari,kasibb'])->group(function() {
        Route::get('papan-kontrol', [papankontrolController::class, 'index'])->name('papan-kontrol');

        Route::resource('beritaacara/ba20', ba_20Controller::class);
        Route::resource('beritaacara/ba23', ba_23Controller::class);
        Route::resource('beritaacara/bensus', bensusController::class);

        Route::get('/rekapan-data-pemusnahan', [rekapandatapemusnahanController::class, 'index'])->name('rekapan-data-pemusnahan');
        Route::get('/rekapan-data-pemusnahan-filter/{start_date?}/{end_date?}', [rekapandatapemusnahanController::class, 'filter'])->name('rekapan-data-pemusnahan-filter');

        Route::get('/rekapan-data-dikembalikan', [rekapandatadikembalikanController::class, 'index'])->name('rekapan-data-dikembalikan');
        Route::get('/rekapan-data-dikembalikan-filter/{start_date?}/{end_date?}', [rekapandatadikembalikanController::class, 'filter'])->name('rekapan-data-dikembalikan-filter');

        Route::get('/rekapan-data-bensus', [rekapandatabensusController::class, 'index'])->name('rekapan-data-bensus');
        Route::get('/rekapan-data-bensus-filter/{start_date?}/{end_date?}', [rekapandatabensusController::class, 'filter'])->name('rekapan-data-bensus-filter');

        Route::get('/rekapan-data-pinjambb', [rekapandatapinjambbController::class, 'index'])->name('rekapan-data-pinjambb');
        Route::get('/rekapan-data-pinjambb-filter/{start_date?}/{end_date?}', [rekapandatapinjambbController::class, 'filter'])->name('rekapan-data-pinjambb-filter');
    });

    Route::middleware(['userAkses:stafbb,jaksa'])->group(function(){
        Route::get('peminjaman_bb/{peminjaman_bb}/print', [peminjamanbbController::class, 'print']);
    });

    Route::middleware(['userAkses:stafbb'])->group(function() { 
        Route::resource('pangkat', pangkatController::class);
        Route::resource('pegawai', pegawaiController::class);
        Route::resource('user', userController::class);
        
        Route::get('beritaacara/ba20/{ba20}/print', [ba_20Controller::class, 'print_ba20']);
        Route::get('beritaacara/ba23/{ba23}/print', [ba_23Controller::class, 'print_ba23']);
        Route::get('beritaacara/bensus/{bensu}/print', [bensusController::class, 'print_bensus']);

        Route::get('/beritaacara/ba20/view/pdf', [ba_20Controller::class, 'view_pdf']);
        Route::get('/beritaacara/ba20/download/pdf', [ba_20Controller::class, 'download_pdf']);
        Route::get('/beritaacara/ba20/print', [ba_20Controller::class, 'print']);

        Route::get('/beritaacara/ba23/view/pdf', [ba_23Controller::class, 'view_pdf']);
        Route::get('/beritaacara/ba23/download/pdf', [ba_23Controller::class, 'download_pdf']);
        Route::get('/beritaacara/ba23/print', [ba_23Controller::class, 'print']);

        Route::get('/beritaacara/bensus/view/pdf', [bensusController::class, 'view_pdf']);
        Route::get('/beritaacara/bensus/download/pdf', [bensusController::class, 'download_pdf']);
        Route::get('/beritaacara/bensus/print', [bensusController::class, 'print']);
    });
});

    




// Route::get('/papan-kontrol/filter/{status_bb?}', [papankontrolController::class, 'index'])->name('papan-kontrol-filter');

// Route::resource('ba23', ba23Controller::class);

// Route::resource('contoh', contohController::class);
// Route::resource('pangkat', pangkatController::class);


// Route::middleware(['auth', 'userAkses:kasibb'])->group(function() { 

// });

// Route::middleware(['auth', 'userAkses:kajari'])->group(function() { 


// });

// Route::middleware(['auth', 'userAkses:jaksa'])->group(function() { 

// });


// Route::get('/nota', function () {
//     return view('bensus.beritaacarabensus');
// });



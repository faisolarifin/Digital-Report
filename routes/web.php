<?php

use App\Http\Controllers\Adminkas;
use App\Http\Controllers\Authentikasi;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Verification;

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

Route::get('/', function() {
   return "landing page";
});

//MANUAL AUTH
Route::get('/login', [Authentikasi::class, 'formLogin'])->name('login');
Route::post('/login', [Authentikasi::class, 'actionLogin'])->name('login.auth');
Route::get('/register', [Authentikasi::class, 'formRegister'])->name('register');
Route::post('/register', [Authentikasi::class, 'actionRegister'])->name('register.auth');
Route::get('/logout', [Authentikasi::class, 'logout'])->name('auth.logout');
//GOOGLE AUTH
Route::get('auth/google', [Authentikasi::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [Authentikasi::class, 'handleGoogleCallback'])->name('auth.google.callback');
//FACEBOOK AUTH
Route::get('auth/facebook', [Authentikasi::class, 'redirectToFacebook'])->name('auth.fb');

Route::prefix('laporan')->middleware(['laporan', 'verified', 'auth'])->group(function() {
    Route::prefix('/{thn?}')->group(function() {
        Route::prefix('/{bln?}')->group(function() {
            Route::get('/', [Adminkas::class, 'indexDataKas'])->name('rep.kas');
        });
    });
});
Route::prefix('users')->middleware(['verified', 'auth'])->group(function() {
    Route::get('/', function() {
        return view('users.index');
    })->name('users');
});
Route::prefix('backup')->middleware(['verified', 'auth'])->group(function() {
    Route::get('/', function() {
        return view('users.index');
    })->name('backup');
});

Route::prefix('api')->middleware(['verified', 'auth'])->group(function() {
    Route::post('/bread', [Adminkas::class, 'getBread'])->name('api.bread');
    Route::get('/menutahun', [Adminkas::class, 'getTahun'])->name('api.tahun');
    Route::post('/savekas', [Adminkas::class, 'saveDataKas'])->name('api.kas.s');
    Route::delete('/deletekas', [Adminkas::class, 'deleteDataKas'])->name('api.kas.d');
    Route::post('/datakas/{id?}', [Adminkas::class, 'getDataKas'])->name('api.kas.r');
    Route::put('/updatekas', [Adminkas::class, 'updateDataKas'])->name('api.kas.u');
    Route::post('/savetahun', [Adminkas::class, 'saveTahun'])->name('api.thn.s');
    Route::delete('/deletetahun', [Adminkas::class, 'deleteTahun'])->name('api.thn.d');
    Route::post('/dataperiode/{id?}', [Adminkas::class, 'getPeriodeSaldo'])->name('api.periode.r');
    Route::post('/saveperiode', [Adminkas::class, 'savePeriodeSaldo'])->name('api.periode.s');
    Route::delete('/deleteperiode', [Adminkas::class, 'deletePeriodeSaldo'])->name('api.periode.d');
    Route::put('/updateperiode', [Adminkas::class, 'updatePeriodeSaldo'])->name('api.periode.u');
});

Route::group(['middleware' => ['auth']], function() {

    /**
     * Verification Routes
     */
    Route::get('/email/verify', [Verification::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [Verification::class, 'verify'])->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', [Verification::class, 'resend'])->name('verification.resend');

});

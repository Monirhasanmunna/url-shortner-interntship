<?php

use App\Http\Controllers\ConfgurationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UrlShorterController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::group(['middleware' => ['auth', 'verified']], function(){

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(['as' => 'url.'], function(){
        Route::get('/', [UrlShorterController::class, 'index'])->name('index');
        Route::post('/store', [UrlShorterController::class, 'store'])->name('store');
        Route::get('/l/{shorterlink}', [UrlShorterController::class, 'shorterLinkShow'])->name('show')->middleware('spamGuard');
        Route::delete('/delete/{id}', [UrlShorterController::class, 'destroy'])->name('destroy');
    });

    Route::group(['as' => 'config.', 'prefix' => 'config'], function(){
        Route::get('/',[ConfgurationController::class,'index'])->name('index');
        Route::post('/store',[ConfgurationController::class,'update'])->name('store');
    });
});


require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\EnseignementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenseeController;
use App\Models\Pensee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\View\ViewException;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/evangelisation', function () {
    return view('evangelisation.index');
})->name('evang');

Route::get('/evangelisation/accepter-jesus', function () {
    return view('evangelisation.salut');
})->name('accepter-jesus');

//enseignement
Route::middleware(['auth'])->group(function () {
    Route::resource('enseignements', EnseignementController::class)->except(['show']); // La route show sera accessible sans auth

    Route::get('/enseignements/{enseignement}', [EnseignementController::class, 'show'])->name('enseignements.show');
});

Route::get('/evenements', function () {
    return view('evenements');
})->name('events');

Route::get('/a-propos', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

//Pensées du jour
Route::get('/pensees-du-jour', [PenseeController::class, 'index'])->name('pensees.index');
Route::post('/pensee-du-jour', [PenseeController::class, 'store'])->name('pensees.store');
Route::get('/pensee-du-jour/{id}', [PenseeController::class, 'show'])->name('pensees.show');

Route::get('/admin', function () {
    return view('admin.dash');
});

Route::get('/article', function () {
    return view('article');
});

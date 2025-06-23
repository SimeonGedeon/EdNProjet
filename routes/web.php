<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenseeController;
use App\Models\Pensee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\View\ViewException;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/evangelisation', function () {
    return view('evangelisation');
})->name('evang');

Route::get('/enseignements', function () {
    $today = Carbon::now();
    return view('enseignements', compact('today'));
})->name('enseig');

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
Route::get('/pensee-du-jour/{id}', [PenseeController::class, 'show'])->name('pensees.show');

Route::get('/admin', function () {
    return view('admin.dash');
});

Route::post('/pensees', [PenseeController::class, 'store']);
Route::get('/pensees', [PenseeController::class, 'index']);

Route::get('/article', function () {
    return view('article');
});

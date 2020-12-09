<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\VisitController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/doctors/edit/{id}', [DoctorController::class, 'edit']);

Route::get('/doctors/create', [DoctorController::class, 'create']);

Route::get('/doctors', [DoctorController::class, 'index']);

Route::get('/doctors/{id}', [DoctorController::class, 'show']);

Route::get('/doctors/specializations/{id}', [DoctorController::class, 'listBySpecialization']);

Route::get('/visits', [VisitController::class, 'index']);

Route::get('/specializations', [SpecializationController::class, 'index']);

//niezapomniec dodać controllera w USE u gory pliku !!!!!









/*

Route::get('/test/{name}/{number?}', function ($name, $number = 100) {
    return "Witaj " . $name . " - " . $number;
});


Route::prefix('admin')->group(function () {
    Route::get('/test/{name}/{number?}', function ($name, $number = 200) {
        return "Witaj " . $name . " - " . $number;
    })->name('trasaTestowa');
});
*/
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

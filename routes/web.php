<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EntryConttroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'getprofile'])->name('profile.get');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/survey',[EntryConttroller::class, 'create']);
Route::post('/survey/store',[EntryConttroller::class, 'store'])->name('entries.store');

//survey Routes.
Route::get('get/survey',[SurveyController::class,'get'])->name('get.survey');
Route::get('create/survey',[SurveyController::class,'create'])->name('create.survey');
Route::post('store/survey',[SurveyController::class,'store'])->name('store.survey');
Route::post('update/survey',[SurveyController::class,'update'])->name('update.survey');


///Entry Routes.
Route::post('post/entry',[SurveyController::class,'storeEntry'])->name('store.entry');
Route::get('delete/question/{id}',[SurveyController::class,'DeleteQuestion'])->name('delete.question');

Route::post('/mark-notification-as-read/{notification}', [SurveyController::class, 'MarkAsRead']);


//Doctors Routes.
Route::get('all/doctors',[DoctorController::class,'AllDoctor'])->name('all.doctors');
Route::post('create/doctor',[DoctorController::class,'createDoctor'])->name('create.doctor');
Route::post('update/doctor',[DoctorController::class,'updateDoctor'])->name('update.doctor');
Route::get('delete/doctor/{id}',[DoctorController::class,'deleteDoctor'])->name('delete.doctor');


//appointments Routes.

Route::get('all/appointments',[DoctorController::class, 'get'])->name('get.appointments');
Route::post('create/appointments',[DoctorController::class, 'create'])->name('create.appointment');
Route::post('update/appointments',[DoctorController::class, 'update'])->name('update.appointment');
Route::get('delete/appointment/{id}',[DoctorController::class, 'Delete'])->name('delete.appointment');



require __DIR__.'/auth.php';

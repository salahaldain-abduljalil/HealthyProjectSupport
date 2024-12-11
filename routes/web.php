<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EntryConttroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
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

Route::get('/survey', [EntryConttroller::class, 'create']);
Route::post('/survey/store', [EntryConttroller::class, 'store'])->name('entries.store');

//survey Routes.
Route::get('get/survey', [SurveyController::class, 'get'])->name('get.survey');
Route::get('create/survey', [SurveyController::class, 'create'])->name('create.survey');
Route::post('store/survey', [SurveyController::class, 'store'])->name('store.survey');
Route::post('update/survey', [SurveyController::class, 'update'])->name('update.survey');


///Entry Routes.
Route::post('post/entry', [SurveyController::class, 'storeEntry'])->name('store.entry');
Route::get('delete/question/{id}', [SurveyController::class, 'DeleteQuestion'])->name('delete.question');

Route::post('/mark-notification-as-read/{notification}', [SurveyController::class, 'MarkAsRead']);


//Doctors Routes.
Route::get('all/doctors', [DoctorController::class, 'AllDoctor'])->name('all.doctors');
Route::post('create/doctor', [DoctorController::class, 'createDoctor'])->name('create.doctor');
Route::post('update/doctor', [DoctorController::class, 'updateDoctor'])->name('update.doctor');
Route::get('delete/doctor/{id}', [DoctorController::class, 'deleteDoctor'])->name('delete.doctor');


//appointments Routes.

Route::get('all/appointments', [DoctorController::class, 'get'])->name('get.appointments');
Route::post('create/appointments', [DoctorController::class, 'create'])->name('create.appointment');
Route::post('update/appointments', [DoctorController::class, 'update'])->name('update.appointment');
Route::get('delete/appointment/{id}', [DoctorController::class, 'Delete'])->name('delete.appointment');
Route::get('getdoctor/data/{id}', [DoctorController::class, 'getdoctorData']);

Route::get('allstudent/reservationsappointment', [DoctorController::class, 'AllreservedAppointment'])->name('get.reservationsappointment');
Route::get('confirm/booking/{id}', [DoctorController::class, 'ConfirmreservedAppointment'])->name('confirm.booking');
Route::get('cancel/booking/{id}', [DoctorController::class, 'CancelreservedAppointment'])->name('cancel.booking');


//Reservation student Routes.

Route::get('allstudent/reservation', [StudentController::class, 'get'])->name('get.reservations');
Route::get('allstudent/reservationemergency', [StudentController::class, 'getAllEmergency'])->name('get.reservationsemergency');
Route::post('create/emergencystatus', [StudentController::class, 'CreateEmergency'])->name('create.reservationemergency');
Route::get('delete/emergencystatus/{id}', [StudentController::class, 'Deletemergency'])->name('delete.reservationemergency');
Route::post('studentcreate/reservation', [StudentController::class, 'Create'])->name('create.reservation');
Route::post('studentupdate/reservation', [StudentController::class, 'Update'])->name('update.reservation');
Route::get('studentdelete/reservation/{id}', [StudentController::class, 'Delete'])->name('delete.reservation');

//Articles Routes.
Route::get('all/articles',[BlogController::class,'getAllArticles'])->name('get.allarticles');
Route::get('create/article',[BlogController::class,'CreateArticle'])->name('create.article');
Route::post('store/article',[BlogController::class,'StoreArticle'])->name('store.article');
Route::get('edit/article{id}',[BlogController::class,'getArticletoEdit'])->name('edit.article');
Route::get('delete/article{id}',[BlogController::class,'DeleteArticle'])->name('delete.article');
Route::post('update/article',[BlogController::class,'updateArticle'])->name('update.article');

Route::get('blog/details/{slug}',[BlogController::class, 'BlogDetails']);

Route::post('comment/send-comments', [BlogController::class, 'sendComment'])->name('comment.send-comment');


require __DIR__ . '/auth.php';

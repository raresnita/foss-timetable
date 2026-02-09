<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TimetableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

//Route::get('/register')

Route::get('/groups', GroupController::class);
Route::get('/groups/{group:name}', [TimetableController::class, 'groupTimetable'])->name('groups.timetable');

Route::get('/professors', ProfessorController::class);
Route::get('/professors/{professor:id}', [TimetableController::class, 'professorTimetable'])->name('professors.timetable');

Route::get('/classrooms', ClassroomController::class);
Route::get('/classrooms/{classroom:name}', [TimetableController::class, 'classroomTimetable'])->name('classrooms.timetable');


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);
});

Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');



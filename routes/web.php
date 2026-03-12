<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('index');
});

Route::get('/groups', GroupController::class);
Route::get('/groups/{group:name}', [TimetableController::class, 'groupTimetable'])->name('groups.timetable');

Route::get('/professors', ProfessorController::class);
Route::get('/professors/{professor:id}', [TimetableController::class, 'professorTimetable'])->name('professors.timetable');

Route::get('/classrooms', ClassroomController::class);
Route::get('/classrooms/{classroom:name}', [TimetableController::class, 'classroomTimetable'])->name('classrooms.timetable');

Route::post('/notifications/send', [NotificationController::class, 'send'])->name('notifications.send');

if (!config('app.demo_mode')) {
    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create']);
        Route::post('/register', [RegisteredUserController::class, 'store']);

        Route::get('/login', [SessionController::class, 'create']);
        Route::post('/login', [SessionController::class, 'store']);
    });
}

Route::post('/demo-login/{role}', function ($role) {
    if (!config('app.demo_mode')) abort(403);

    $email = match ($role) {
        'admin' => 'demo_admin@test.test',
        'prof' => 'demo_prof@test.test',
        'stud' => 'demo_stud@test.test',
        default => abort(404),
    };

    Auth::login(User::where('email', $email)->first());
    return redirect()->intended('/');
});

Route::middleware(['auth', 'can:admin-only'])->group(function () {
    Route::get('/manage/users', [AdminController::class, 'manageUsers']);
    Route::get('/manage/classrooms', [AdminController::class, 'manageClassrooms']);
    Route::get('/manage/groups', [AdminController::class, 'manageGroups']);
});

Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ro'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
});

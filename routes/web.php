<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PupilsController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [MainController::class, 'index']);

    # Schedule
    Route::get('/schedules', [ScheduleController::class, 'teacher']);
    Route::get('/schedule/add', [ScheduleController::class, 'add']);
    Route::post('/schedule/create', [ScheduleController::class, 'create']);
    Route::post('/schedule/delete', [ScheduleController::class, 'delete']);
    Route::get('/schedule/edit/id/{id}', [ScheduleController::class, 'editForm']);
    Route::post('/schedule/save', [ScheduleController::class, 'save']);
    Route::get('/schedule/show/id/{id}', [ScheduleController::class, 'show']);
    Route::post('/schedule/double',[ScheduleController::class,'double']);
    Route::get('/schedule/pupil',[ScheduleController::class,'pupil']);

    # Pupils
    Route::get('/pupils', [PupilsController::class, 'list']);
    Route::get("/pupils/list/classroom/id/{id}", [PupilsController::class, 'classroom']);
    Route::get("/pupils/search/", [PupilsController::class, 'search']);
    Route::post('/pupils/add/schedule',[PupilsController::class,'addSchedule']);

    # Classroom
    Route::get('/classroom', [ClassroomController::class, 'list']);
    Route::match(['get', 'post'], '/classroom/add', [ClassroomController::class, 'add']);
    Route::get('/classroom/edit/id/{id}', [ClassroomController::class, 'editForm']);
    Route::post('/classroom/edit/', [ClassroomController::class, 'edit']);
    Route::post('/classroom/delete', [ClassroomController::class, 'delete']);
    Route::post('/classroom/pupil/unlink/', [ClassroomController::class, 'unlinkPupil']);
    Route::post('/classroom/pupil/link/', [ClassroomController::class, 'linkPupil']);


    # Subjects
    Route::get('/subjects', [SubjectsController::class, 'list']);
    Route::match(['get', 'post'], '/subject/add', [SubjectsController::class, 'add']);
    Route::match(['get', 'post'], '/subject/edit/id/{id}', [SubjectsController::class, 'edit']);
    Route::post('/subject/delete', [SubjectsController::class, 'delete']);


    # Generate pupils (for classroom)
    Route::post('/generate/classroom/pupils', [GenerateController::class, 'generatePupils']);
    Route::get('/generate/entities', [GenerateController::class, 'generateAll']);


//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->middleware(['auth'])->name('dashboard');

    Route::get('/profile', [UserController::class, 'show']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

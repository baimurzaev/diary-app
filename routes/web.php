<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PupilsController;
use App\Http\Controllers\ScheduleController;
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
    Route::match(['get', 'post'], '/schedule/add', [ScheduleController::class, 'add']);
    Route::get('/schedules', [ScheduleController::class, 'list']);

    # Classroom
    Route::get('/classroom', [ClassroomController::class, 'list']);
    Route::match(['get', 'post'], '/classroom/add', [ClassroomController::class, 'add']);
    Route::match(['get', 'post'], '/classroom/edit/id/{id}/', [ClassroomController::class, 'edit']);
    Route::post('/classroom/delete', [ClassroomController::class, 'delete']);
    Route::get("/classroom/pupils/list/id/{id}", [ClassroomController::class, 'pupilsList']);

    # Generate users (for classroom)
    Route::post('/generate/classroom/pupils', [GenerateController::class, 'generatePupils']);

    # Groups
    Route::get('/groups', [GroupsController::class, 'list']);
    Route::match(['get', 'post'], '/groups/add', [GroupsController::class, 'add']);
    Route::get('/groups/edit/id/{id}/', [GroupsController::class, 'edit']);
    Route::post('/groups/edit', [GroupsController::class, 'edit']);
    Route::post('/groups/delete', [GroupsController::class, 'delete']);
    Route::get("/groups/pupils/list/id/{id}", [GroupsController::class, 'pupilsList']);

    # Pupils
    Route::get('/pupils', [PupilsController::class, 'list']);


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/generate/entities', [GenerateController::class, 'generateAll']);
});

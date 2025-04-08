<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');

// Personal Tasks
Route::get('/tasks/create-personal', [TasksController::class, 'createPersonalTask'])->name('tasks.create-personal');
Route::post('/tasks/store-personal', [TasksController::class, 'storePersonalTask'])->name('tasks.store-personal');
Route::get('/tasks/{task}/edit-personal', [TasksController::class, 'editPersonalTask'])->name('tasks.edit-personal');
Route::put('/tasks/{task}/update-personal', [TasksController::class, 'updatePersonalTask'])->name('tasks.update-personal');

// Assigned Tasks
Route::get('/tasks/create-assigned', [TasksController::class, 'createAssignedTask'])->name('tasks.create-assigned');
Route::post('/tasks/store-assigned', [TasksController::class, 'storeAssignedTask'])->name('tasks.store-assigned');
Route::get('/tasks/{task}/edit-assigned', [TasksController::class, 'editAssignedTask'])->name('tasks.edit-assigned');
Route::put('/tasks/{task}/update-assigned', [TasksController::class, 'updateAssignedTask'])->name('tasks.update-assigned');

// General Routes
Route::resource('tasks', TasksController::class)->except(['create', 'store', 'edit', 'update']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TasksController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

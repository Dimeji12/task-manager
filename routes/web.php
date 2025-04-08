<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Tasks Routes
    Route::prefix('tasks')->group(function () {
        // Personal Tasks
        Route::get('/create-personal', [TasksController::class, 'createPersonalTask'])->name('tasks.create-personal');
        Route::post('/store-personal', [TasksController::class, 'storePersonalTask'])->name('tasks.store-personal');
        Route::get('/{task}/edit-personal', [TasksController::class, 'editPersonalTask'])->name('tasks.edit-personal');
        Route::put('/{task}/update-personal', [TasksController::class, 'updatePersonalTask'])->name('tasks.update-personal');

        // Assigned Tasks
        Route::get('/create-assigned', [TasksController::class, 'createAssignedTask'])->name('tasks.create-assigned');
        Route::post('/store-assigned', [TasksController::class, 'storeAssignedTask'])->name('tasks.store-assigned');
        Route::get('/{task}/edit-assigned', [TasksController::class, 'editAssignedTask'])->name('tasks.edit-assigned');
        Route::put('/{task}/update-assigned', [TasksController::class, 'updateAssignedTask'])->name('tasks.update-assigned');

        // General Tasks (using resource except for specific actions)
        Route::resource('', TasksController::class)
            ->parameters(['' => 'task'])
            ->names('tasks')
            ->except(['create', 'store', 'edit', 'update']);
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
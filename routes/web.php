<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Route::get('/tasks', [TasksController::class, 'index'])->middleware(['auth', 'verified'])->name('tasks.index');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');

   
    Route::get('/tasks/{task}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TasksController::class, 'update'])->name('tasks.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

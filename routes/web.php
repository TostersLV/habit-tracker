<?php

use App\Http\Controllers\HabitController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/index', [HabitController::class, 'index'])->middleware(['auth'])->name('index');
Route::get('/habit/create', [HabitController::class, 'create'])->middleware(['auth'])->name('create');
Route::get('/statitics', [HabitController::class, 'statitics'])->middleware(['auth'])->name('statitics');
Route::get('/leaderboard', [HabitController::class, 'leaderboard'])->middleware(['auth'])->name('leaderboard');
Route::post('/create', [HabitController::class, 'store'])->middleware(['auth'])->name('habits.store');
Route::delete('/habits/{habit}', [HabitController::class, 'destroy'])->middleware(['auth'])->name('habits.destroy');
Route::post('/habits/{habit}/completed', [HabitController::class, 'setCompletedToday'])->name('habits.completed');
Route::get  ('/calendar', [HabitController::class, 'calendar'])->middleware(['auth'])->name('calendar');

Route::post('/habits/{habit}/completed-today', [HabitController::class, 'setCompletedToday'])
    ->middleware(['auth'])
    ->name('habits.completed-today');


require __DIR__.'/auth.php';

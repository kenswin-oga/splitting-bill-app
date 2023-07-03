<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MakeRoomController;
use App\Http\Controllers\IntoRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/room/{room}', [RoomController::class, 'show'])
->name('room.show');

Route::get('/room/{room}/edit',[RoomController::class, 'edit'])->name('room_edit');
Route::post('/room/{room}/edit',[RoomController::class, 'store'])->name('room_edit.store');

Route::get('/make_room',[MakeRoomController::class, 'make_room'])->name('make_room');
Route::post('/make_room',[MakeRoomController::class, 'store'])->name('make_room.store');

Route::get('/into_room',[IntoRoomController::class, 'into_room'])->name('into_room');
Route::post('/into_room',[IntoRoomController::class, 'store'])->name('into_room.store');

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

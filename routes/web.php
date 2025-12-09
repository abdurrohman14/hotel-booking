<?php

use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [RoomTypeController::class, 'dashboard'])->name('admin.dashboard');


    // Room
    Route::prefix('rooms')->group(function () {
        Route::get('/index', [RoomTypeController::class, 'index'])->name('room.index');
        Route::get('/create', [RoomTypeController::class, 'create'])->name('room.create');
        Route::post('/store', [RoomTypeController::class, 'store'])->name('room.store');
        Route::get('/edit/{id}', [RoomTypeController::class, 'edit'])->name('room.edit');
        Route::post('/update/{id}', [RoomTypeController::class, 'update'])->name('room.update');
        Route::delete('/delete/{id}', [RoomTypeController::class, 'destroy'])->name('room.delete');
    });

    // Reservation
    Route::prefix('reservations')->group(function () {
        Route::get('/index', [ReservationController::class, 'index'])->name('reservation.index');
        Route::patch('/reservation/{id}/status', [ReservationController::class, 'updateStatus'])
            ->name('reservation.updateStatus');
    });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [BookingController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/reservation-history', [BookingController::class, 'historyUser'])
    ->name('user.reservation.history');

    Route::get('/booking/create/{id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
});
require __DIR__ . '/auth.php';

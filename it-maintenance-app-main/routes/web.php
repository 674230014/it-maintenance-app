<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RepairController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/technician/dashboard', [RepairController::class, 'technicianIndex'])->name('technician.dashboard');
    Route::get('/repair/create', [RepairController::class, 'create'])->name('repairs.create');
    Route::post('/repair', [RepairController::class, 'store'])->name('repairs.store');
    Route::get('/repair/history', [RepairController::class, 'history'])->name('repairs.history');

    Route::patch('/repair/{repair}/status', [RepairController::class, 'updateStatus'])->name('repairs.updateStatus');
    Route::post('/repair/{repair}/slip', [RepairController::class, 'uploadSlip'])->name('repairs.uploadSlip');
    Route::post('/repair/{repair}/approve', [RepairController::class, 'approveSlip'])->name('repairs.approveSlip');
    Route::get('/repair/{repair}/receipt', [RepairController::class, 'receipt'])->name('repairs.receipt');
});

Route::get('/', function() {
    return redirect()->route('login');
});
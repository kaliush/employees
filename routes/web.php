<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::patch('/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });

    Route::prefix('positions')->group(function () {
        Route::get('/', [PositionController::class, 'index'])->name('positions.index');
        Route::get('/create', [PositionController::class, 'create'])->name('positions.create');
        Route::post('/', [PositionController::class, 'store'])->name('positions.store');
        Route::get('/{position}', [PositionController::class, 'show'])->name('positions.show');
        Route::get('/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');
        Route::patch('/{position}', [PositionController::class, 'update'])->name('positions.update');
        Route::delete('/{position}', [PositionController::class, 'destroy'])->name('positions.destroy');
    });
});


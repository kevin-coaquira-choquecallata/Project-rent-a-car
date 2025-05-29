<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\LavaderoController;
use App\Http\Controllers\MecanicoController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\HistorialController;
use App\Http\Middleware\AdminMiddleware;

// Redirección raíz al login
Route::get('/', function () {
    return redirect('/login');
});

// Auth y perfil
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    // Registro
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Oficina
    Route::prefix('oficina')->group(function () {
        Route::get('/', [OficinaController::class, 'index'])->name('oficina.index');
        Route::put('/{id}', [OficinaController::class, 'actualizar'])->name('oficina.actualizar');
        Route::post('/vehiculos', [OficinaController::class, 'store'])->name('oficina.vehiculos.store');
        Route::delete('/vehiculos/{vehiculo}', [OficinaController::class, 'destroy'])->name('oficina.vehiculos.destroy');
        Route::get('/mecanico', [OficinaController::class, 'verMecanico'])->name('oficina.mecanico');
        Route::get('/pendientes', [OficinaController::class, 'verPendientes'])->name('oficina.pendientes');
        Route::get('/sin-plaza', [OficinaController::class, 'verListosSinPlaza'])->name('oficina.sinplaza');
    });

    // Lavadero
    Route::prefix('lavadero')->group(function () {
        Route::get('/', [LavaderoController::class, 'index'])->name('lavadero.index');
        Route::put('/{id}', [LavaderoController::class, 'actualizar'])->name('lavadero.actualizar');
    });

    // Mecánico
    Route::prefix('mecanico')->group(function () {
        Route::get('/', [MecanicoController::class, 'index'])->name('mecanico.index');
        Route::put('/{vehiculo}', [MecanicoController::class, 'actualizar'])->name('mecanico.actualizar');
    });

    // Parking
    Route::prefix('parking')->group(function () {
        Route::get('/', [ParkingController::class, 'index'])->name('parking.index');
        Route::get('/alquilados', [ParkingController::class, 'alquilados'])->name('parking.alquilados');
        Route::put('/{id}/alquilar', [ParkingController::class, 'alquilar'])->name('parking.alquilar');
        Route::put('/{id}/devolucion', [ParkingController::class, 'devolucion'])->name('parking.devolucion');
    });

    // Historial
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
});

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/usuarios', [UserManagementController::class, 'index'])->name('admin.usuarios');
    Route::post('/usuarios/{user}/actualizar-rol', [UserManagementController::class, 'actualizarRol'])->name('admin.usuarios.actualizar');
    Route::delete('/usuarios/{user}', [UserManagementController::class, 'eliminar'])->name('admin.usuarios.eliminar');
});

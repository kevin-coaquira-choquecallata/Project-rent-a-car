<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\LavaderoController;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//Codigo registro
Route::get('/register',[RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/test-email', function () {
    try {
        Mail::raw('Esto es un correo de prueba desde Laravel', function ($message) {
            $message->to('TU_CORREO_REAL@gmail.com')
                    ->subject('Correo de prueba');
        });
        return 'Correo enviado correctamente.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
//Vehiculo 
Route::get('/',[CatalogoController::class,'index']);

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/usuarios', [UserManagementController::class, 'index'])->name('admin.usuarios');
    Route::post('/admin/usuarios/{user}/actualizar-rol', [UserManagementController::class, 'actualizarRol'])->name('admin.usuarios.actualizar');
});
//Borrar usuario solo admin puede 
Route::delete('/admin/usuarios/{user}',[UserManagementController::class,'eliminar'])->name('admin.usuarios.eliminar');
//View inicio 
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user() && Auth::user()->role_id === null) {
            return view('sinrol');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::get('/lavadero',function(){
        if(Auth::user()->role && Auth::user()->nombre === 'lavadero'){
            return view('roles.lavadero');
        }
        abort(403,'Acceso no autorizado');
    })->name('lavadero');

    Route::get('/oficina',function(){
        if(Auth::user()->role && Auth::user()->role->nombre === 'oficina'){
            return view('roles.oficina');
        }
        abort(403,'Acceso no autorizado');
    })->name('oficina');

    Route::get('/mecanico',function(){
        if(Auth::user()->role && Auth::user()->role->nombre === 'mecanico'){
            return view('roles.mecanico');
        }
        abort(403,'Acceso no autorizado');
    })->name('mecanico');
});
Route::get('/oficina', [OficinaController::class, 'index'])->name('oficina.index');
Route::put('/oficina/{id}', [OficinaController::class, 'actualizar'])->name('oficina.actualizar');

//Oficina
Route::middleware(['auth'])->group(function(){
    Route::get('/oficina',[OficinaController::class,'index'])->name('oficina.index');
    Route::put('/oficina/{id}',[OficinaController::class, 'actualizar'])->name('oficina.actualizar');
});
//Lavadero
Route::middleware(['auth'])->group(function () {
    Route::get('/lavadero', [LavaderoController::class, 'index'])->name('lavadero.index');
    Route::put('/lavadero/{id}', [LavaderoController::class, 'actualizar'])->name('lavadero.actualizar');
});


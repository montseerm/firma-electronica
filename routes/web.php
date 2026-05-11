<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Rutas de monitoreo para Nagios
|--------------------------------------------------------------------------
*/

Route::get('/health', function () {
    return response('OK - firma-electronica', 200);
});

Route::get('/health-db', function () {
    try {
        DB::select('SELECT 1');

/// verificar que la base de datos esté conectada 

        return response('OK - BASE DE DATOS CONECTADA', 200);
    } catch (\Exception $e) {

/// laravel no puede comunicarse con la base de datos 

        return response('ERROR - BASE DE DATOS SIN CONEXION', 500);
    }
});

require __DIR__.'/auth.php';
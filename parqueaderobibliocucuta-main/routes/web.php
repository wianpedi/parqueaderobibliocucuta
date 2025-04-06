<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkingController;

/*
|--------------------------------------------------------------------------
| Rutas del sistema de parqueadero
|--------------------------------------------------------------------------
*/

// Ruta principal: Muestra el formulario de entrada
Route::get('/', [ParkingController::class, 'showEntryForm'])->name('parking.entry-form');

// Registrar entrada de vehículo
Route::post('/entry', [ParkingController::class, 'registerEntry'])->name('parking.entry');

// Mostrar formulario de salida
Route::get('/exit', [ParkingController::class, 'showExitForm'])->name('parking.exit-form');

// Registrar salida de vehículo
Route::post('/exit', [ParkingController::class, 'registerExit'])->name('parking.exit');

// Cerrar caja
Route::get('/cash-register', [ParkingController::class, 'closeCashRegister'])->name('parking.cash-register');
Route::get('/exited-vehicles', [ParkingController::class, 'showExitedVehicles'])->name('parking.exited-vehicles');
Route::get('/reports', [ParkingController::class, 'showReportsForm'])->name('reports');
Route::post('/reports', [ParkingController::class, 'generateReport'])->name('generate.report');
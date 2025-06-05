<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\EmpresaController;

Route::prefix('empresas')->group(function () {
    Route::get('/', [EmpresaController::class, 'index']); // Listar todas las empresas
    Route::get('/{nit}', [EmpresaController::class, 'show']); // Consultar empresa por NIT
    Route::post('/', [EmpresaController::class, 'store']); // Crear empresa
    Route::put('/{nit}', [EmpresaController::class, 'update']); // Actualizar empresa
    Route::delete('/inactivas', [EmpresaController::class, 'destroyInactive']); // Borrar empresas inactivas
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

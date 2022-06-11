<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubsidiaryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/brands', [BrandController::class, 'index']);

Route::prefix('/brand')->group(
    function () {
        Route::post('/store', [BrandController::class, 'store']);
        Route::put('/{id}', [BrandController::class, 'update']);
        Route::delete('/{id}', [BrandController::class, 'destroy']);
        Route::get('/listar', [BrandController::class, 'listar']);
    }
);

Route::get('/galeries', [GaleryController::class, 'index']);

Route::prefix('/galery')->group(
    function () {
        Route::get('/list/{id}', [GaleryController::class, 'list']);
        Route::post('/store', [GaleryController::class, 'store']);
        Route::delete('/{id}', [GaleryController::class, 'destroy']);
    }
);

//Route::get('/galeries', [GaleryController::class, 'index']);

Route::get('/roles', [RoleController::class, 'index']);
Route::prefix('/role')->group(
    function () {
        //Route::post('/store', [RoleController::class, 'store']);
        //Route::put('/{id}', [RoleController::class, 'update']);
        //Route::delete('/{id}', [RoleController::class, 'destroy']);
        Route::get('/listar', [RoleController::class, 'listar']);
    }
);

Route::get('/users', [UserController::class, 'index']);

Route::prefix('/user')->group(
    function () {
        Route::post('/store', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::get('/list', [UserController::class, 'list']);
    }
);

Route::get('/administrators', [AdministratorController::class, 'index']);

Route::prefix('/administrator')->group(
    function () {
        Route::post('/store', [AdministratorController::class, 'store']);
        //Route::put('/{id}', [AdministratorController::class, 'update']);
        Route::delete('/{id}', [AdministratorController::class, 'destroy']);
        Route::get('/list', [AdministratorController::class, 'list']);
    }
);

Route::get('/employees', [EmployeeController::class, 'index']);

Route::prefix('/employee')->group(
    function () {
        Route::post('/store', [EmployeeController::class, 'store']);
        Route::put('/{id}', [EmployeeController::class, 'update']);
        Route::delete('/{id}', [EmployeeController::class, 'destroy']);
        Route::get('/list', [EmployeeController::class, 'list']);
    }
);

Route::get('/subsidiaries', [SubsidiaryController::class, 'index']);

Route::prefix('/subsidiary')->group(
    function () {
        //Route::post('/store', [SubsidiaryController::class, 'store']);
        //Route::put('/{id}', [SubsidiaryController::class, 'update']);
        //Route::delete('/{id}', [SubsidiaryController::class, 'destroy']);
        Route::get('/list', [SubsidiaryController::class, 'list']);
    }
);
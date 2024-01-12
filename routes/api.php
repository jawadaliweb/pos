<?php

use App\Http\Controllers\Api\EmployeeAPI;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

// });

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('employee', EmployeeController::class, ['except' => ['index']] );

});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


    // Add more routes here as needed


// Route::get('employees', [EmployeeAPI::class, 'index']);
// Route::delete('/employee/{id}', [EmployeeApi::class, 'DeleteEmployee']);

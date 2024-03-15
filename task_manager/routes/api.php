<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user/roles', ['UserController@getUserRoles']);
    Route::post('/user/assign-role', ['UserController@assignRole'])->middleware('privileged');
    
    Route::apiResource('/tasks', TaskController::class);
    // Route::get('/tasks/all', [TaskController::class, 'allTasks'])->middleware('privileged');
});


// Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
// Route::apiResource('/tasks', TaskController::class)->middleware('auth:sanctum');
// Route::middleware(['auth:sanctum', 'privileged'])->group(function () {
//     Route::apiResource('/tasks', TaskController::class);
// });
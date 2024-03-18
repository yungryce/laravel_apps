<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\RoleController;
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

    Route::get('/user/{user}/roles', [RoleController::class, 'getUserRoles']);
    Route::post('/user/assign-role', [RoleController::class, 'assignRole'])
        ->middleware('privileged');
    
    Route::apiResource('/tasks', TaskController::class)
        ->only(['index', 'store', 'show', 'update','destroy']);
    // Route::get('/tasks/all', [TaskController::class, 'allTasks'])->middleware('privileged');
});


// Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
// Route::apiResource('/tasks', TaskController::class)->middleware('auth:sanctum');
// Route::middleware(['auth:sanctum', 'privileged'])->group(function () {
//     Route::apiResource('/tasks', TaskController::class);
// });
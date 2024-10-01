<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\RepositoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login', [ApiTokenController::class, 'login']);
Route::post('/auth/register', [ApiTokenController::class, 'register']);
Route::middleware('auth:sanctum')->post('/auth/logout', [ApiTokenController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/repo', [RepositoryController::class, 'index']);
//Route::middleware(['auth:sanctum', 'abilities:repo-view'])->get('/repo', [RepositoryController::class, 'index']);

Route::middleware('auth:sanctum')->post('/repo', [RepositoryController::class, 'store']);
//Route::middleware(['auth:sanctum', 'abilities:repo-create'])->post('/repo', [RepositoryController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () { 
    Route::post('/create/project', [ProjectController::class, 'store']);
    Route::get('/project/{id}', [ProjectController::class, 'show']);
    Route::put('/project/{id}', [ProjectController::class, 'update']);
    Route::delete('/project/{id}', [ProjectController::class, 'destroy']);
    
    
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{projectId}/tasks', [TaskController::class, 'index']);

    Route::post('/create/task', [TaskController::class, 'store']);
    Route::put('/projects/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/projects/tasks/{id}', [TaskController::class, 'destroy']);
    
    
 });

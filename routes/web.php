<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ApiTokenController;

Route::get('/', function () {
    return redirect('/projects');
});


Route::get('/login', [ApiTokenController::class, 'login_index'])->name('login');
Route::get('/register', [ApiTokenController::class, 'register']);
// ,'auth:sanctum'
Route::middleware(['bearer.token', 'auth:sanctum' ])->group(function () { 
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/project/{id}', [ProjectController::class, 'show'])->name('projects.show');

});
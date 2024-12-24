<?php

use App\Http\Controllers\ChantierController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('/login', [UserController::class, 'login']);

// Chantiers
Route::get('/chantiers', [ChantierController::class, 'index']);
Route::put('/chantiers/{id}', [ChantierController::class, 'update']);

// Groupe
Route::get('/groups', [GroupeController::class, 'index']);
Route::post('/groups', [GroupeController::class, 'create']);
Route::put('/groups/{id}', [GroupeController::class, 'update']);

// Column
// Route::get('/columns', [GroupeController::class, 'index']);
Route::post('/columns', [ColumnController::class, 'create']);
// Route::put('/columns/{id}', [GroupeController::class, 'update']);

// Tasks
Route::get('/tasks', [TaskController::class, 'index']);
// Route::post('/tasks', [TaskController::class, 'create']);
// Route::put('/columns/{id}', [GroupeController::class, 'update']);

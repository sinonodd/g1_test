<?php

use App\Http\Controllers\ChantierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('/login', [UserController::class, 'login']);

// Chantiers
Route::get('/chantiers', [ChantierController::class, 'index']);
Route::put('/chantiers/{id}', [ChantierController::class, 'update']);

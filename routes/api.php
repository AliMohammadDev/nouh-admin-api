<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LinkTypeController;
use App\Http\Controllers\Api\MajorController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware(['setLocale'])->group(function () {

  Route::apiResource('majors', MajorController::class);
  Route::apiResource('link-types', LinkTypeController::class);
  Route::apiResource('categories', CategoryController::class);
  Route::get('projects/{project}/related', [ProjectController::class, 'related']);
  Route::post('/projects/{project}/like', [ProjectController::class, 'like']);
  Route::apiResource('projects', ProjectController::class);
  Route::apiResource('tags', TagController::class);
});

// for image vr 360
Route::get('/vr-proxy', [ProjectController::class, 'vrProxy']);
<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MajorController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Route;


Route::middleware(['setLocale'])->group(function () {

  Route::apiResource('majors', MajorController::class);
  Route::apiResource('categories', CategoryController::class);
  Route::apiResource('projects', ProjectController::class);
  Route::apiResource('tags', TagController::class);
});

<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\LinkTypeController;
use App\Http\Controllers\Api\MajorController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('setLocale')->group(function (): void {
  Route::apiResource('majors', MajorController::class)->only(['index', 'show']);
  Route::apiResource('link-types', LinkTypeController::class)->only(['index', 'show']);
  Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

  // Register custom endpoints before the resource's {project} route.
  Route::prefix('projects')->name('projects.')->controller(ProjectController::class)->group(function (): void {
    Route::get('featured', 'featured')->name('featured');
    Route::get('top-liked', 'topLiked')->name('top-liked');
    Route::get('{project}/related', 'related')->name('related');
    Route::post('{project}/like', 'like')->middleware('throttle:10,1')->name('like');
  });

  Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);
  Route::apiResource('tags', TagController::class)->only(['index', 'show']);

  Route::get('users/images', [UserController::class, 'userImages']);

  Route::post('contact', [ContactController::class, 'sendContact'])->middleware('throttle:5,1');
});

// The 360-degree image proxy does not require locale middleware.
Route::get('vr-proxy', [ProjectController::class, 'vrProxy'])->name('vr-proxy');

<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return redirect('/admin');
});

Route::get('/storage-link', function () {
  Artisan::call('storage:link');
  return 'Storage linked successfully!';
});

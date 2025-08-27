<?php

use App\Http\Controllers\RadioController;

use Illuminate\Support\Facades\Route;

Route::get('/', [RadioController::class, 'index']);

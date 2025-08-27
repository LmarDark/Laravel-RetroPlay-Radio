<?php

use App\Http\Controllers\RadioController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/radio/status', [RadioController::class, 'status']);

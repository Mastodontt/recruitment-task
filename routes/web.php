<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::resource('pets', PetController::class);

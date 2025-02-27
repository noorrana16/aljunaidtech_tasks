<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Students;
use App\Http\Controllers\DemoController;
use Resources\views\layouts\main;




//Task-1
Route::get('/MyInfo',[DemoController::class,'showInfo']);
Route::get('/Swap-values',[DemoController::class, 'swapValues']);
Route::get('/data-types', [DemoController::class, 'showdatatypes']);

//Task-2
Route::get('/Arithmetic', [DemoController::class, 'Arithmetic']);
Route::get('/Assignment', [DemoController::class, 'Operate']);
Route::get('/Logical', [DemoController::class, 'logical']);











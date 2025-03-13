<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Students;
use App\Http\Controllers\DemoController;
use Resources\views\layouts\main;
use App\Http\Controllers\ArrayController;

//Laravel:Task-2
Route::get('/array', [ArrayController::class, 'indexedArray']);
Route::get('/employees', [ArrayController::class, 'Employees']);
Route::get('/books', [ArrayController::class, 'showBooks']);
Route::get('/students', [ArrayController::class, 'Students']);
Route::get('/fibonacci', [ArrayController::class, 'fibonacciSeries']);
Route::post('/table', [ArrayController::class, 'generateTable']);
Route::get('/multi-table', [ArrayController::class, 'showTable']);
Route::post('/grade', [ArrayController::class, 'assignGrade']);
Route::get('/grade-form', [ArrayController::class, 'showGrade']);
Route::get('/', [ArrayController::class, 'showForm']);
Route::post('/paragraph', [ArrayController::class, 'Paragraph']);


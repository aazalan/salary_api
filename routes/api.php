<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/employee', [EmployeeController::class, 'createEmployee']);

Route::post('/employee/hours', [EmployeeController::class, 'createTransaction']);

Route::get('/salaries', [SalaryController::class, 'showAll']);

Route::delete('/salaries', [SalaryController::class, 'cancelTransactions']);



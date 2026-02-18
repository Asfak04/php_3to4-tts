<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LeaveController::class, 'index']);
Route::post('/', [LeaveController::class, 'store']);
Route::get('/employee_show/{id}', [LeaveController::class, 'show']);
Route::get('/employee_edit/{id}', [LeaveController::class, 'edit']);
Route::post('/employee_edit/{id}', [LeaveController::class, 'update']);
Route::get('/employee_delete/{id}', [LeaveController::class, 'destroy']);







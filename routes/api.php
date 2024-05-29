<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExportController;

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

Route::get('/getAllData',[CustomerController::class, 'index']);
Route::get('/getRecords', [CustomerController::class, 'getRecords']);
Route::get('/getRequestData/{id}', [Customercontroller::class, 'getRecordsRequest']);
Route::get('/getRecordExport/{id}', [Customercontroller::class, 'getRecordsExport']);
Route::get('/countData',[CustomerController::class, 'countData']);
Route::get('/exportCustomers', [ExportController::class, 'exportCustomers']);

Route::post('/login', [userController::class, 'login']);
Route::post('/register',[userController::class, 'store']);
Route::post('/uploadData',[CustomerController::class, 'uploadExcel']);

Route::delete('/deleteRecords/{id}',[CustomerController::class, 'deleteRecords']);

Route::middleware('auth:sanctum')->get('/retrieve', [userController::class, 'getUserDetails']);

Route::post('/logout', [userController::class, 'logout'])->middleware('auth:sanctum');

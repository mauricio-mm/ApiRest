<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExcelApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('api')->group(function () {
    Route::get('status',[ExcelApiController::class,'index'])->name('status');
    Route::get('show/{id}',[ExcelApiController::class,'show'])->name('show');
    Route::delete('delete/{id}',[ExcelApiController::class,'delete'])->name('delete');
});

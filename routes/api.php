<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckListController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// отримати список товарів

Route::get('/checkList/{id}', [CheckListController::class , 'show']);
Route::post('/checkList', [CheckListController::class , 'store']);
Route::put('/checkList', [CheckListController::class , 'update']);
Route::put('/checkList/changeStatus/{id}', [CheckListController::class , 'changeStatus']);

// зберехти список товарів

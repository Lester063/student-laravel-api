<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ItemController;
use App\Http\Controllers\api\ReturnController;
use App\Http\Controllers\api\RequestController;
use App\Http\Controllers\Api\RequestCommunicationController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
//display items
Route::get('items', [ItemController::class,'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);

    //request item
    Route::post('requests', [RequestController::class,'store']);

    //get user request/s
    Route::get('userrequest', [RequestController::class,'indexUser']);

    //request comm -As as User, I would like to follow up with my request status or any queries.
    Route::post('requestcommunication', [RequestCommunicationController::class,'store']);
    Route::get('requestcommunication/{id}', [RequestCommunicationController::class,'show']);

    //return item
    Route::post('return', [ReturnController::class,'store']);
    //return - user view
    Route::get('userreturns', [ReturnController::class,'indexUser']);
});

Route::middleware('auth:sanctum', 'is_admin')->group(function(){

    Route::post('items', [ItemController::class,'store']);
    Route::get('items/{id}', [ItemController::class,'show']);
    Route::get('items/{id}/edit', [ItemController::class,'edit']);
    Route::get('items/{id}/itemrequest', [ItemController::class,'itemRequest']);
    Route::put('items/{id}/edit', [ItemController::class,'update']);
    Route::delete('items/{id}/delete', [ItemController::class,'delete']);

    Route::get('requests', [RequestController::class,'indexAdmin']);

    //request -admin
    Route::put('actionrequest/{id}/edit', [RequestController::class,'actionRequest']);


    //return - approve 
    Route::put('return/{id}/approve', [ReturnController::class,'approve']);
    //return - admin view
    Route::get('returns', [ReturnController::class,'indexAdmin']);

});



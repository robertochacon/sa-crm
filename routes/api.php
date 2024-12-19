<?php

use App\Http\Controllers\Api\v1\TestController;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\Category\CategoryController;
use App\Http\Controllers\Api\v1\WebSocket\WebSocketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => 'api'], function () {

    //for acount
    Route::post('login', [AuthController::class, 'login']);
    Route::post('login/code', [AuthController::class, 'loginWithCode']);
    Route::post('register', [AuthController::class, 'register']);

});

Route::middleware(['auth:api'])->group(function () {

    //categories
    Route::get('/categories/{company_id}', [CategoryController::class, 'index']);

    //test
    Route::get('/test', [TestController::class, 'index']);

    //for acount
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);

    //websockets
    Route::post('/websocket/send', [WebSocketController::class, 'sendMessage']);

});

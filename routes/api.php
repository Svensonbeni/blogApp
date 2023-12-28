<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
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



Route::post('/persons/register',[AuthController::class, 'register'])->name('register');
Route::post('/persons/login',[AuthController::class, 'login'])->name('login');
Route::get('/articles',[ArticleController::class, 'index']);

// Route::post('/articles/create',[ArticleController::class, 'store']);
// Route::put('/articles/edit/{article}',[ArticleController::class, 'update']);
// Route::delete('/articles/{article}',[ArticleController::class, 'delete']);

Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('/articles/create',[ArticleController::class, 'store']);
    Route::put('/articles/edit/{article}',[ArticleController::class, 'update']);
    Route::delete('/articles/{article}',[ArticleController::class, 'delete']);
    Route::post('/persons/logout',[AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
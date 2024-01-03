<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CategorieController;
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
Route::get('/articles',[ArticleController::class, 'index'])->name('lesArticles');
Route::get('/categories',[CategorieController::class, 'index'])->name('listeCategorie');
Route::get('/articles/{article}',[ArticleController::class, 'show']);
Route::get('articles/{article}/comments',[CommentController::class, 'index']);

// ***************** routes protégées ************************

Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('/articles/create',[ArticleController::class, 'store']);
    Route::put('/articles/edit/{article}',[ArticleController::class, 'update']);
    Route::delete('/articles/{article}',[ArticleController::class, 'delete']);
    Route::post('/persons/logout',[AuthController::class, 'logout'])->name('logout');

    // routes des commentaires
    Route::post('articles/{article}/comments/create',[CommentController::class, 'store']);
    Route::put('/comments/edit/{comment}',[CommentController::class, 'update']);
    Route::delete('/comments/{comment}',[CommentController::class, 'delete']);

    // routes des categories
    Route::post('categories/create',[CategorieController::class, 'store']);
    Route::put('/categories/edit/{categorie}',[CategorieController::class, 'update']);
    Route::delete('/categories/{categorie}',[CategorieController::class, 'delete']);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
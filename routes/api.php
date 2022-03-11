<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;


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



//Authors Route

Route::group(['prefix' => 'author'], function()
{
    Route::get('/', [AuthorController::class, 'index']);
    Route::get('/{id}', [AuthorController::class, 'get']);
    Route::post('/create', [AuthorController::class, 'create']);
    Route::post('/edit/{id}', [AuthorController::class, 'update']);
    Route::delete('/{id}', [AuthorController::class, 'delete']);

});


// //Files Routes

Route::group(['prefix' => 'file'], function()
{
    Route::get('/', [FileController::class, 'index']);
    Route::get('/{id}', [FileController::class, 'get']);
    Route::post('/create', [FileController::class, 'create']);
    Route::post('/edit/{id}', [FileController::class, 'update']);
    Route::delete('/{id}', [FileController::class, 'delete']);

});

Route::group(['prefix' => 'category'], function()
{
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}', [CategoryController::class, 'get']);
    Route::post('/create', [CategoryController::class, 'create']);
    Route::post('/edit/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'delete']);

});


Route::group(['prefix' => 'book'], function()
{
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{id}', [BookController::class, 'get']);
    Route::post('/create', [BookController::class, 'create']);
    Route::post('/edit/{id}', [BookController::class, 'update']);
    Route::delete('/{id}', [BookController::class, 'delete']);

});

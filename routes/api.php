<?php

use App\Http\Controllers\ApiReaderNewsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth:api']], function () {
    // JWT Auth
    Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:api']);
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);


    // // News data
    Route::get('news', [ApiReaderNewsController::class, 'index']); //News list
    Route::get('news/{id}', [ApiReaderNewsController::class, 'show']); //Data of a news and readers
    Route::get('news/{id}/readers', [ApiReaderNewsController::class, 'get_readers_of_a_news']); //readers of a news selected
    // Reader data
    Route::get('reader/{id}', [ApiReaderNewsController::class, 'reader']); //data reader
    Route::get('reader/{id}/news', [ApiReaderNewsController::class, 'get_news_readed_for_a_reader']); //readers of a news selected
});




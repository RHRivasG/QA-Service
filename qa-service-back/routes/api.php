<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[AuthController::class,'login']);
Route::get('/questions/accepted', [QuestionController::class,'showAccepted'])->name('question.accepted');

//Protected routes-Only authenticated users can have access to protected routes//
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout',[AuthController::class,'logout']);

    Route::post('/questions/create',[QuestionController::class,'doQuestion'])->name('question.create');
    
    Route::get('/questions/pending', [QuestionController::class,'showPending'])->name('question.pending');
    Route::get('/questions/denied', [QuestionController::class,'showDenied'])->name('question.denied');
    Route::post('/questions/answer',[QuestionController::class,'doAnswer'])->name('question.answer');
    Route::post('/questions/deny',[QuestionController::class,'denyQuestion'])->name('question.deny');
 });

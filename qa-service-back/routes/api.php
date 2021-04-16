<?php

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

Route::get('/questions/accepted', [QuestionController::class,'showAccepted']);
Route::get('/questions/pending', [QuestionController::class,'showPending']);
Route::get('/questions/denied', [QuestionController::class,'showDenied']);
Route::post('/questions/create',[QuestionController::class,'questionStore']);
Route::post('/questions/answer',[QuestionController::class,'answerStore']);
Route::post('/questions/deny',[QuestionController::class,'denyQuestion']);

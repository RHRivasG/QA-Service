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
Route::post('/register',[AuthController::class,'register']);
Route::get('/questions/accepted', [QuestionController::class,'showAccepted']);


//Protected routes-Only authenticated users can have access to protected routes//
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout',[AuthController::class,'logout']);

    Route::post('/questions/create',[QuestionController::class,'doQuestion']);
    
    Route::get('/questions/pending', [QuestionController::class,'showPending']);
    Route::get('/questions/denied', [QuestionController::class,'showDenied']);
    Route::post('/questions/answer',[QuestionController::class,'doAnswer']);
    Route::post('/questions/deny',[QuestionController::class,'denyQuestion']);
 });

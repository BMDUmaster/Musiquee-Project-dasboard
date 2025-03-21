<?php

use App\Http\Controllers\API\ArtistController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EditController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegistrationAPI;
use App\Http\Controllers\API\FollowController;
use App\Http\Controllers\API\FileUploadController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!

*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/google', [AuthController::class, 'googleLogin']);
Route::post('/auth/facebook', [AuthController::class, 'facebookLogin']);
Route::post('/API/Register',[RegistrationAPI::class,'APIRegister']);
Route::post('/login', [RegistrationAPI::class, 'loginApi']);
Route::post('/logout', [RegistrationAPI::class, 'logout'])->middleware('auth:sanctum');
Route::put('/edit/{id}',[EditController::class,'updateUser']);
Route::get('/getUser',[FollowController::class,'getUserData'])->middleware('auth:sanctum');
Route::middleware('/auth:sanctum')->group(function () {
Route::post('/follow', [FollowController::class, 'follow']);
Route::post('/unfollow', [FollowController::class, 'unfollow']);
Route::get('/user/{userId}/followers-following', [FollowController::class, 'getFollowersAndFollowing']);

});

Route::post('/song',[FileUploadController::class,'UploadSong']);
Route::delete('/songs/{id}', [FileUploadController::class, 'deleteSong']);


Route::post('/artistUpload',[ArtistController::class,'ArtistUpload']);
Route::get('/artistGet',[ArtistController::class,'GetArtistData']);
Route::put('/update-artist/{id}', [ArtistController::class, 'UpdateArtist']);

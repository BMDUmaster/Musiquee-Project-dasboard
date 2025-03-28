<?php

use App\Http\Controllers\API\RegistrationAPI;
use App\Http\Controllers\artistController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/artist',[artistController::class,'artist'])->name('view');
    Route::post('/post',[artistController::class,'artistLogic'])->name('post');

    Route::get('/musicAdd',[MusicController::class,'musicShow'])->name('addMusic');
    Route::post('post/data',[MusicController::class,'Categuary'])->name('post.data');
    Route::delete('/deletepost/{id}',[MusicController::class,'delete'])->name('music.delete');
    Route::get('/music/edit/{id}', [MusicController::class, 'edit'])->name('music.edit');
    Route::post('/music/update/{id}', [MusicController::class, 'update'])->name('music.update');


    Route::get('/getSong',[SongController::class,'SongOpen'])->name('getSong');
    Route::post('/sendSong',[SongController::class,'SongUpload'])->name('sendSong');

    Route::get('/user.Registration',[RegistrationAPI::class,'UserDataGet'])->name('User.Registration');
    Route::POST('/user/post',[UserController::class,'UserdataUpload'])->name('User.post');

});



require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;

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

Route::get('/', [GalleryController::class, 'index'])->name('home');
Route::get('/register', function(){return view('pages.register');});
Route::post('/register', [UserController::class, 'store'])->name('signUp');
Route::get('/login', function(){return view('pages.login');});
Route::post('/login', [UserController::class, 'logOn'])->name('logOn');
Route::get('/logout', [UserController::class, 'logOff'])->name('logOff');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/{id}', [UserController::class, 'update'])->name('update-profile');
    Route::get('/gallery/{id}', [GalleryController::class, 'gallery'])->name('gallery');
    Route::get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('edit-gallery');
});

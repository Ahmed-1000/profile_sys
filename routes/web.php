<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('profile.index');
});

Auth::routes();

Route::post('follow/{user}',[App\Http\Controllers\followscontroller::class, 'store']); 

Route::get('/home', [App\Http\Controllers\Homecontroller::class, 'home']);
Route::get('/home/chat',[App\Http\Controllers\Homecontroller::class, 'chatview']);
Route::get('/home/chat/{id}',[App\Http\Controllers\Homecontroller::class, 'view_one'])->name('view_message');
Route::get('/post/create', [App\Http\Controllers\postcontroller::class, 'create'])->name('postc');
Route::post('/post', [App\Http\Controllers\postcontroller::class, 'store'])->name('postcreate');
Route::get('/post/{post}', [App\Http\Controllers\postcontroller::class, 'show']);
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'indexV'])->name('home');
Route::get('/profile/{user}', [App\Http\Controllers\profilescontroller::class, 'index'])->name('profil.show');
Route::get('/profile/{user}/Edit', [App\Http\Controllers\profilescontroller::class, 'edit'])->name('profil.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\profilescontroller::class, 'update'])->name('profil.update');



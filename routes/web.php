<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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
    return view('welcome');
});
Route::get('user/name/{name?}', function (?string $name = 'John'){
    Log::info('Find user:', ['name'=> $name]);
    return "Name: ". "$name";
})->name("profile");

Route::get('user/{$id}', [UserController::class, 'show'])->name('profile');
Route::resource('photos', PhotoController::class);
Route::get('users', [UserController::class,'index'])->name('users.index');
Route::get('users/create', [UserController::class,'create'])->name('users.create');
Route::get('users/{name}', [UserController::class,'show'])->name('profileUser');
Route::post('users/store', [UserController::class,'store'])->name('users.store');

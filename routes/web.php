<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use Illuminate\Auth\Events\Logout;
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
    // return view('home');
    if (!auth()->check()) {
        return redirect('/login');
    }
    if (auth()->user()->role === 'admin') {
        return view('home');
    }
    if (auth()->user()->role === 'customer') {
        return view('customer.home');
    }
})->name('home');
//Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

//Auth Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


//Customer Routes
Route::prefix('customer')->middleware('customer')->name('customer.')->group(function () {
    Route::resource('products', CustomerProductController::class);
    Route::resource('cart', CartController::class);
    Route::post('orders/checkout', [CustomerOrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('orders', [CustomerOrderController::class, 'store'])->name('orders.store');
    Route::get('orders', [CustomerOrderController::class, 'index'])->name('orders.index');
});

//Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::patch('orders/{order}/updateStatus', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('dashboard', DashboardController::class);

});

// Route::get('user/name/{name?}', function (?string $name = 'John'){
//     Log::info('Find user:', ['name'=> $name]);
//     return "Name: ". "$name";
// })->name("profile");

// Route::get('user/{$id}', [UserController::class, 'show'])->name('profile');
// Route::resource('photos', PhotoController::class);
// Route::get('users', [UserController::class,'index'])->name('users.index');
// Route::get('users/create', [UserController::class,'create'])->name('users.create');
// Route::get('users/{name}', [UserController::class,'show'])->name('profileUser');
// Route::post('users/store', [UserController::class,'store'])->name('users.store');

<?php

use App\Http\Controllers\UserController;
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
// home page
Route::get('/', function () {
    return view('index')->with('index', true);
});
// login
Route::get('/login', function () {
    return view('index')->with('login', true);
});
// register
Route::get('/register', function () {
    return view('index')->with('register', true);
});

// form action controller
Route::post('/create_user', [UserController::class, 'createUser']);
Route::post('/login_user', [UserController::class, 'loginUser']);

// dashboard
Route::get('/dashboard', [UserController::class, 'dashboard']);

// logout
Route::get('/logout', [UserController::class, 'logout']);

// upgrade plan
Route::get('/upgrade', [UserController::class, 'upgradePlan']);
// Payment Verification
Route::get('/payment/verify', [UserController::class, 'verifyPayment']);


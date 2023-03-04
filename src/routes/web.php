<?php

use App\Http\Controllers\AuthController;
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
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/home', function () {
    return view('home');
});

Route::middleware('check.auth')->group(function () {
    Route::get('/features', function () {
        return view('features');
    });

    Route::get('/pricing', function () {
        return view('pricing');
    });
});

Route::get('/register', function () {
    return view('/register');
});

Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

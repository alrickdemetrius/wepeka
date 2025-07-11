<?php

use App\Http\Controllers\HeadquartersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientProfileController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('client.headquarters.index');
// });



// Auth::routes();

// tanpa login
Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// login client
Route::middleware(['auth', 'role:client'])->prefix('client')->as('client.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::get('/headquarters',[HeadquartersController::class, 'index'])->name('headquarters');
    Route::get('/profile', [ClientProfileController::class, 'index'])->name('profile');
});

// login admin

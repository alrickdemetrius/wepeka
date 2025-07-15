<?php

use App\Http\Controllers\ClientLinkController;
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
Route::get('/download/{filename}', function ($filename) {
    $path = storage_path('app/public/pdfs/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path, $filename, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
})->name('file.download');

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
    Route::get('/headquarters', [HeadquartersController::class, 'index'])->name('headquarters');

    Route::get('/link', [ClientLinkController::class, 'index'])->name('link');
    Route::post('/link/store', [ClientLinkController::class, 'store'])->name('link.store');
    Route::get('/link/edit/{id}', [ClientLinkController::class, 'edit'])->name('link.edit');
    Route::post('/link/update/{id}', [ClientLinkController::class, 'update'])->name('link.update');
    Route::delete('/link/delete/{id}', [ClientLinkController::class, 'destroy'])->name('link.destroy');

    Route::get('/profile', [ClientProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ClientProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/update-email', [ClientProfileController::class, 'updateEmail'])->name('profile.update-email');
    Route::put('/profile/update-password', [ClientProfileController::class, 'updatePassword'])->name('profile.update-password');
});

// login admin

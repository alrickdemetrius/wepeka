<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeadquartersController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\QrLinkController as AdminQrLinkController;
use App\Http\Controllers\Client\QrLinkController as ClientQrLinkController;
use App\Http\Controllers\ClientProfileController;

/*
|--------------------------------------------------------------------------
| Universal Route (Redirect Root)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isClient()) {
            return redirect()->route('client.headquarters');
        } elseif (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
    }

    // Untuk tamu (belum login), tampilkan halaman home
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| File Download (Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::get('/download/{filename}', function ($filename) {
    $path = storage_path('app/public/pdfs/' . $filename);
    if (!file_exists($path)) abort(404);

    return response()->download($path, $filename, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
})->name('file.download');

/*
|--------------------------------------------------------------------------
| Guest Routes (Login)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:client'])->prefix('client')->as('client.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/headquarters', [HeadquartersController::class, 'index'])->name('headquarters');

    // Profile
    Route::get('/profile', [ClientProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ClientProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/update-email', [ClientProfileController::class, 'updateEmail'])->name('profile.update-email');
    Route::put('/profile/update-password', [ClientProfileController::class, 'updatePassword'])->name('profile.update-password');

    // QR Link (Client)
    Route::get('/link', [ClientQrLinkController::class, 'index'])->name('link.view_link');
    Route::get('/link/edit', [ClientQrLinkController::class, 'edit'])->name('link.edit_link');
    Route::put('/link/update', [ClientQrLinkController::class, 'update'])->name('link.update');
    // Route::get('/link/download-qr', [ClientQrLinkController::class, 'downloadQr'])->name('link.download_qr');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [AdminUserController::class, 'index'])->name('dashboard');

    // User Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');

    // QR Management
    Route::get('/clients', [AdminUserController::class, 'index'])->name('clients.index');
    Route::get('/clients/{user}/qr/create', [AdminQrLinkController::class, 'create'])->name('qr.create');
    Route::post('/clients/{user}/qr/store', [AdminQrLinkController::class, 'store'])->name('qr.store');
    Route::get('/clients/{user}/qr/show', [AdminQrLinkController::class, 'show'])->name('qr.show');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeadquartersController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\QrLinkController as AdminQrLinkController;
use App\Http\Controllers\Client\QrLinkController as ClientQrLinkController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Models\Portfolio;

/*
|--------------------------------------------------------------------------
| Universal Route (Redirect Root)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $featuredPortfolios = Portfolio::where('is_featured', true)->latest()->get();
    return view('home', compact('featuredPortfolios'));
})->name('home');

Route::get('/booking', function () {
    $featuredPortfolios = \App\Models\Portfolio::where('is_featured', true)
                            ->latest()
                            ->take(3)
                            ->get();
    return view('client.booking', compact('featuredPortfolios'));
})->name('booking');

Route::get('/socials', function () {
    return view('socials');
})->name('socials');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');
/*
|--------------------------------------------------------------------------
| Public Route for QR Redirection (Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::get('/qr/{slug}', [ClientQrLinkController::class, 'redirect'])->name('client.qr.redirect');

/*
|--------------------------------------------------------------------------
| Public File Download (Tanpa Login)
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
    Route::delete('/profile/delete-logo', [ClientProfileController::class, 'deleteLogo'])->name('profile.delete-logo');


    // QR Link (Client View & Management)
    Route::get('/link', [ClientQrLinkController::class, 'index'])->name('link.view_link');
    Route::get('/link/edit', [ClientQrLinkController::class, 'edit'])->name('link.edit_link');
    Route::put('/link/update', [ClientQrLinkController::class, 'update'])->name('link.update');
    Route::get('/r/{slug}', [ClientQrLinkController::class, 'redirect'])->name('link.redirect');
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
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // QR Management
    Route::get('/clients', [AdminUserController::class, 'index'])->name('clients.index');
    Route::get('/clients/{user}/qr/create', [AdminQrLinkController::class, 'create'])->name('qr.create');
    Route::post('/clients/{user}/qr/store', [AdminQrLinkController::class, 'store'])->name('qr.store');
    Route::get('/clients/{user}/qr/show', [AdminQrLinkController::class, 'show'])->name('qr.show');
    Route::delete('/clients/{user}/qr/delete', [AdminQrLinkController::class, 'destroy'])->name('qr.destroy');
    Route::get('/clients/{user}/qr/edit', [AdminQrLinkController::class, 'edit'])->name('qr.edit');
    Route::put('/clients/{user}/qr/update', [AdminQrLinkController::class, 'update'])->name('qr.update');
    Route::get('/qr/{id}/download', [AdminQrLinkController::class, 'downloadSvg'])->name('qr.download');

    Route::resource('portfolios', PortfolioController::class);
});

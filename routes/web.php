<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CompanyProfileController as AdminCompanyController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\PromoController as AdminPromoController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Sisi Pembaca / Pengunjung)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak/kirim-pesan', [ContactController::class, 'sendMessage'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes (Sisi Admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Kelola Produk
        Route::resource('products', AdminProductController::class, ['as' => 'admin']);
        Route::delete('products/{product}/delete-image', [AdminProductController::class, 'deleteImage'])->name('admin.products.delete-image');

        // Kelola Kategori
        Route::resource('categories', AdminCategoryController::class, ['as' => 'admin']);

        // Kelola Promo / Banner
        Route::resource('promos', AdminPromoController::class, ['as' => 'admin']);
        Route::delete('promos/{promo}/delete-image', [AdminPromoController::class, 'deleteImage'])->name('admin.promos.delete-image');

        // Kelola Informasi Perusahaan
        Route::get('/company-profile', [AdminCompanyController::class, 'edit'])->name('admin.company.edit');
        Route::put('/company-profile', [AdminCompanyController::class, 'update'])->name('admin.company.update');
        Route::delete('/company-profile/delete-image', [AdminCompanyController::class, 'deleteImage'])->name('admin.company.delete-image');

        // Kelola Kontak & Lokasi
        Route::get('/contact', [AdminContactController::class, 'edit'])->name('admin.contact.edit');
        Route::put('/contact', [AdminContactController::class, 'update'])->name('admin.contact.update');

        // Kelola Akun Admin
        Route::resource('users', AdminUserController::class, ['as' => 'admin']);
    });
});

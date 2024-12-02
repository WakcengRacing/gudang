<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

use App\Http\Controllers\auth\AuthenticatedSessionController;
use App\Http\Controllers\auth\RegisteredUserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);
// routes/web.php



// Rute untuk melihat daftar akun yang login
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');

// Rute untuk berpindah akun


Route::get('/switch-account/{user_id}', [ProfileController::class, 'switchAccount'])->name('profile.switch');


// Rute untuk menambah akun baru

// Route untuk menampilkan form menambah akun
Route::get('profile/add', [ProfileController::class, 'showAddAccountForm'])->name('profile.add');

Route::post('/profile/add', [ProfileController::class, 'addAccount'])->name('profile.add.post');
// Route untuk logout
Route::post('logout', [ProfileController::class, 'logout'])->name('logout');


// Rute untuk Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Create Item
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');

    // Edit Item
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');

    //destory admin
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // History Admin
    Route::get('/history', [AdminController::class, 'history'])->name('admin.history');

    // Route untuk menampilkan halaman checkout
    Route::get('/checkout', [AdminController::class, 'showCheckout'])->name('admin.checkout');

    // Route untuk memproses checkout
    Route::post('/checkout', [AdminController::class, 'checkout']);
});

// Rute untuk User
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    // Dashboard User
    Route::get('/', [UserController::class, 'index'])->name('user.index');

   // Route untuk menampilkan halaman checkout
   Route::get('/checkout', [UserController::class, 'showCheckout'])->name('user.checkout');

   // Route untuk memproses checkout
   Route::post('/checkout', [UserController::class, 'checkout']);

    // History User
    Route::get('/history', [UserController::class, 'history'])->name('user.history');
});
require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CatalogController;

// --- CONTROLLER UNTUK ADMIN ---
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\AdminController; // Boleh dibuang jika tidak digunakan lagi untuk route
use App\Http\Controllers\Admin\DiamondTopupController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; // <-- 1. UBAH/TAMBAH INI
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController; // <-- 2. UBAH/TAMBAH INI
use App\Http\Controllers\Admin\MarketAccountController;




// --- CONTROLLER UNTUK PENGGUNA ---
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\MarketplaceController;
use Illuminate\Support\Facades\Vite;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama untuk semua pelawat
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Laluan Dashboard yang akan mengarahkan pengguna atau admin ke tempat yang betul
// Ini adalah untuk dashboard pengguna biasa (User)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

//===========================================================
// KUMPULAN LALUAN UNTUK SEMUA PENGGUNA YANG LOG MASUK
//===========================================================
Route::middleware('auth')->group(function () {

    //--- Laluan Profil (dari Breeze) ---//
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //--- Proses Top-Up oleh Pengguna ---//
    Route::get('/topup/{game:slug}', [TransactionController::class, 'create'])->name('topup.create');
    Route::post('/topup', [TransactionController::class, 'store'])->name('topup.store');
    Route::get('/dashboard', [DashboardController::class, 'index'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');

    //--- Sejarah Transaksi Pengguna ---//
    Route::get('/my-transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/my-transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace.index');
    Route::get('/marketplace/account/{account}', [MarketplaceController::class, 'show'])->name('marketplace.show');
    Route::get('/marketplace/buy/{account}', [MarketplaceController::class, 'showPaymentForm'])->name('marketplace.buy.form');
    // 2. Route untuk memproses borang pembayaran yang dihantar
    Route::post('/marketplace/buy', [MarketplaceController::class, 'processPayment'])->name('marketplace.buy.process');
});


//===========================================================
// KUMPULAN LALUAN UNTUK ADMIN SAHAJA
//===========================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    //--- Dashboard Admin ---//
    // 2. TUKAR BARIS INI
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    //--- Pengurusan Games, Top-up (CRUD) ---//
    Route::resource('games', GameController::class);
    Route::resource('diamond-topups', DiamondTopupController::class);

    //--- Pengurusan Transaksi oleh Admin ---//
    // Jika anda ingin membuat controller berasingan untuk transaksi admin, itu lebih baik.
    // Buat masa ini, kita boleh kekalkannya jika kaedah 'transactions' wujud dalam AdminController anda.
    // Jika tidak, anda perlu cipta Admin\TransactionController.
    // Anda belum berikan saya AdminController, jadi saya andaikan ia masih wujud.
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions.index');
    Route::patch('/transactions/{transaction}/update-status', [AdminController::class, 'updateTransactionStatus'])->name('transactions.updateStatus');
    Route::resource('market-accounts', MarketAccountController::class);
    Route::post('/market/purchase', [\App\Http\Controllers\MarketPurchaseController::class, 'store'])->name('market.purchase.store');
});


Route::get('/debug-url', function () {
    echo '<h1>Hasil Debug URL</h1>';
    echo '<ul>';
    echo '<li><b>request()->isSecure()</b>: ' . (request()->isSecure() ? 'true (Benar)' : 'false (Salah)') . '</li>';
    echo '<li><b>request()->getScheme()</b>: ' . request()->getScheme() . '</li>';
    echo '<li><b>asset("images/test.jpg")</b>: ' . asset('images/test.jpg') . '</li>';
    echo '<li><b>Vite URL</b>: ' . Vite::asset('resources/css/app.css') . '</li>';
    echo '</ul>';
});

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

// Fail laluan pengesahan dari Breeze
require __DIR__.'/auth.php';

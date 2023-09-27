<?php

use App\Http\Controllers\{ManagementController, ProfileController, WalletController};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [ManagementController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Wallet
     */
    Route::get('/carteiras', [WalletController::class, 'index'])->name('wallet.index');
    Route::post('/carteiras', [WalletController::class, 'store'])->name('wallet.store');
    Route::delete('/carteiras/{id}', [WalletController::class, 'destroy'])->name('wallet.destroy');
    Route::put('/wallet', [WalletController::class, 'update'])->name('wallet.update');

    /**
     * Transações
     */
    Route::get('/transacoes', function () {
        return Inertia::render('Transaction');
    })->name('transacoes.index');

    /**
     * Management
     */
    Route::get('/dashboard/{id}', [ManagementController::class, 'index'])->middleware(['auth', 'verified'])->name('management.index');

});

Route::get('/components/buttons', function () {
    return Inertia::render('Components/Buttons');
})->middleware(['auth', 'verified'])->name('components.buttons');

require __DIR__ . '/auth.php';

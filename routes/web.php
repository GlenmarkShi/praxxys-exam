<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products/create', [ProductController::class, 'store'])->name('product.store');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/edit/{id}', [ProductController::class, 'update'])->name('product.update');
// Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::delete('/products/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/search_product', [ProductController::class, 'search'])->name('product.search');



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::resource('products', ProductController::class);

// Route::get('/products', ProductController::class, 'index')->name('product.index');

require __DIR__.'/auth.php';
